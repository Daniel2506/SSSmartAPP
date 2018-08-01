<script type="text/template" id="add-user-tpl">
    {!! Form::open(['id' => 'form-user', 'data-toggle' => 'validator']) !!}

        <div class="row">
            <div class="form-group col-sm-4">
                <label>Nombres</label>
                <input type="text" name="user_name"  class="form-control input-sm input-toupper" placeholder="Nombres" value="<%- user_name %>" required>
            </div>
            <div class="form-group col-sm-4">
                <label>Apellidos</label>
                <input type="text" name="user_lastname"  class="form-control input-sm input-toupper" placeholder="Apellidos"value="<%- user_lastname %>" required>
            </div>
            <div class="form-group col-sm-4">
                <label>Dirección</label>
                <input type="text" name="user_address"  class="form-control input-sm" placeholder="Dirección"value="<%- user_address %>">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-4">
                <label>Teléfono</label>
                <input type="text" name="user_telephone"  class="form-control input-sm" placeholder="Teléfono"value="<%- user_telephone %>">
            </div>
            <div class="form-group col-sm-4">
                <label>Email</label>
                <input type="email" name="user_email" class="form-control input-sm" placeholder="ejemplo@gmail.com" value="<%- user_email %>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-4">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control input-sm" placeholder="Nombre usuario" value="<%- username %>" required>
            </div>
            <div class="form-group col-sm-4">
                <label>Contraseña</label>
                <input type="password" id="password" name="password" class="form-control input-sm" <%- !_.isUndefined(username) && !_.isNull(username) && username != '' ? "" : "required" %>>
            </div>
            <div class="form-group col-sm-4">
                <label>Confirme Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control  input-sm" <%- !_.isUndefined(username) && !_.isNull(username) && username != '' ? "" : "required" %>>
            </div>
        </div>

        <div class="box-footer with-border">
            <div class="row">
                <div class="col-sm-2 col-md-offset-4 col-xs-6 text-left">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                </div>
                <div class="col-sm-2 col-xs-6 text-right">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.create') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    <% if(!_.isUndefined(username) && !_.isNull(username) && username != '') { %>
        <div class=" col-sm-8 col-md-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles de usuario</h3>
                </div>
                <div class="box-body">
                    <form method="POST" accept-charset="UTF-8" id="form-item-roles" data-toggle="validator">
                        <div class="row">
                            <label for="role_id" class="control-label col-sm-1 col-md-offset-1 hidden-xs">Rol</label>
                            <div class="form-group col-md-7 col-xs-9">
                                <select name="role_id" id="role_id" class="form-control select2-default" required>
                                    @foreach( App\Models\Base\Role::getRoles() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2 col-xs-3">
                                <button type="submit" class="btn btn-success btn-sm btn-block">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- table table-bordered table-striped -->
                    <div class="table-responsive no-padding">
                        <table id="browse-roles-list" class="table table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%"></th>
                                    <th width="95%">Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Render content roles --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <% } %>
</script>
<script type="text/template" id="roles-item-list-tpl">
	<% if(edit) { %>
        <td class="text-center">
            <a class="btn btn-default btn-xs item-roles-remove" data-resource="<%- id %>">
                <span><i class="fas fa-times"></i></span>
            </a>
    	</td>
    <% } %>
	<td><%- display_name %></td>
</script>
<script type="text/template" id="add-machine-tpl">
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Serie</label>
            <input type="text" name="maquina_serie"  class="form-control input-sm input-toupper" placeholder="Serie" value="<%- maquina_serie %>" required>
        </div>
        <div class="form-group col-sm-4">
            <label>Ubicación</label>
            <input type="text" name="maquina_ubicacion"  class="form-control input-sm input-toupper" placeholder="Ubicación" value="<%- maquina_ubicacion %>" >
        </div>
        <div class="form-group col-sm-3">
            <label>Documentos</label>
            <input type="text" name="maquina_documentos"  class="form-control input-sm input-toupper" placeholder="Documentos" value="<%- maquina_documentos %>" >
        </div>
        <div class="form-group col-sm-1">
            <label>Casillas</label>
            <input type="number" name="maquina_casillas"  class="form-control input-sm" value="<%- maquina_casillas %>" >
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label>Contacto</label>
            <input type="text" name="maquina_contacto"  class="form-control input-sm input-toupper" placeholder="Contacto" value="<%- maquina_contacto %>">
        </div>
        <div class="form-group col-sm-3">
            <label>Email</label>
            <input type="email" name="maquina_email"  class="form-control input-sm" placeholder="ejemplo@gmail.com" value="<%- maquina_email %>">
        </div>
        <div class="form-group col-sm-3">
            <label>Dirección</label>
            <input type="text" name="maquina_direccion"  class="form-control input-sm input-toupper" placeholder="Dirección" value="<%- maquina_direccion %>">
        </div>
        <div class="form-group col-sm-3">
            <label>Teléfono</label>
            <input type="text" name="maquina_telefono"  class="form-control input-sm" value="<%- maquina_telefono %>" data-inputmask="'mask': '(999) 999-99-99  EXT 999'" data-mask required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label>Servidor</label>
            <input type="text" name="maquina_servidor"  class="form-control input-sm" value="<%- maquina_servidor %>" data-inputmask="'alias': 'ip'" data-mask required >
        </div>
        <div class="form-group col-sm-3">
            <label>Usuario</label>
            <input type="text" name="maquina_usuario"  class="form-control input-sm" placeholder="Usuario" value="<%- maquina_usuario %>" required>
        </div>
        <div class="form-group col-sm-3">
            <label>Contraseña</label>
            <input type="password" name="maquina_contraseña"  class="form-control input-sm" value="<%- maquina_contraseña %>" <%- _.isUndefined(maquina_serie) && _.isNull(maquina_serie) && maquina_serie == '' ? "required" : "" %> >
        </div>
        <div class="form-group col-sm-3">
            <label>Directorio</label>
            <input type="text" name="maquina_directorio"  class="form-control input-sm" placeholder="Directorio" value="<%- maquina_directorio %>" required>
        </div>
    </div>
</script>
