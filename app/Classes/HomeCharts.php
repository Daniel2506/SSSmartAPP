<?php
namespace App\Classes;

use Illuminate\Http\Request;
use App\Models\Base\Machine;

use DB;

class HomeCharts {

    private $sql_condition = "";
    public $error = null;

    function __construct(Request $request)
    {
        // Meses & dias en español
        DB::statement('SET lc_time_names = es_ES');

        if ($request->filled('machine')) {
            $machine = Machine::find($request->machine);
            if (!$machine instanceof Machine) {
                $this->error = "Maquina no se ha recuperado";
                return;
            }
            $this->sql_condition = "AND f.factura_maquina = $machine->id";
        }
    }
    function rotacionPorDia()
    {
        // Rotacion X dia
        $rotacion_dia = new \stdClass();
        $rotacion_dia->labels = [];
        $rotacion_dia->data = [];

        // Prepare query
        $sql = "
            SELECT (COUNT(f.id) / m.maquina_casillas) as result, DATE_FORMAT(f.factura_fecha_emision, '%w') AS day, DATE_FORMAT(f.factura_fecha_emision, '%W') AS day_letters
            FROM facturas as f, maquinas as m WHERE f.factura_fecha_emision > DATE_SUB(DATE(NOW()), INTERVAL 8 DAY) AND f.factura_fecha_emision <= DATE(NOW()) $this->sql_condition
            GROUP BY f.factura_fecha_emision ORDER BY DATE_FORMAT(DATE(NOW()), '%w')";

        // Execute sql
        $query = DB::select($sql);

        // Config chart rotacion X dia
        $rotacion_dia->labels = array_pluck($query, 'day_letters');
        $rotacion_dia->data = array_pluck($query, 'result');

        return $rotacion_dia;
    }
    function rotacionSeisMeses()
    {
        // Rotacion ultimos 6 meses
        $rotacion_smeses = new \stdClass();
        $rotacion_smeses->labels = [];
        $rotacion_smeses->data = [];

        // Prepare query
        $sql = "
            SELECT (COUNT(f.id) / m.maquina_casillas) as result, DATE_FORMAT(f.factura_fecha_emision, '%m') AS month, DATE_FORMAT(f.factura_fecha_emision, '%M') AS month_letters
            FROM facturas as f, maquinas as m WHERE f.factura_fecha_emision <= DATE(NOW()) AND f.factura_fecha_emision > DATE_SUB(DATE(NOW()), INTERVAL 6 MONTH) $this->sql_condition
            GROUP BY month";

        // Execute sql
        $query = DB::select($sql);

        // Config chart roacion ultimos 6 meses
        $rotacion_smeses->labels = array_pluck($query, 'month_letters');
        $rotacion_smeses->data = array_pluck($query, 'result');

        return $rotacion_smeses;
    }
    function ventasSeisMeses()
    {
        $ventas = new \stdClass();
        $ventas->labels = [];
        $ventas->placeholder = [];
        $ventas->data = [];

        // Prepare query
        $sql = "
            SELECT
                SUM(f.factura_subtotal) AS subtotal,
                SUM(f.factura_iva) AS iva,
                SUM(f.factura_subtotal) * (m.maquina_comision1 / 100) + SUM(f.factura_subtotal) * (m.maquina_comision2 / 100) + SUM(f.factura_subtotal) * (m.maquina_comision3 / 100) as comisiones,
                DATE_FORMAT(f.factura_fecha_emision, '%M') AS month_letters, DATE_FORMAT(f.factura_fecha_emision, '%m') AS month
            FROM facturas AS f , maquinas AS m WHERE f.factura_fecha_emision <= DATE(NOW()) AND f.factura_fecha_emision >= DATE_SUB(DATE(NOW()), INTERVAL 6 MONTH) $this->sql_condition
            GROUP BY month";
        // Execute sql
        $query = DB::select($sql);

        // Config chart ventas
        $ventas->labels = array_pluck($query, 'month_letters');
        $ventas->data['comisiones'] = array_pluck($query, 'comisiones');
        $ventas->data['subtotal'] = array_pluck($query, 'subtotal');
        $ventas->data['iva'] = array_pluck($query, 'iva');

        return $ventas;
    }
}
?>
