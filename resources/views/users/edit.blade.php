@extends('layouts.app-master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Usuários</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Usuários</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="bg-light p-4 rounded">
                    <div class="lead">
                        Editar e gerenciar as permissões para o usuário <b>"{{ ucfirst($user->name) }}"</b>.
                    </div>

                    <div class="container mt-4">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Houveram alguns problemas com sua solicitação.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{ route('users.update', $user->id) }}"> 
                            @method('patch')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ $user->name }}"
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Name" required>

                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input value="{{ $user->email }}"
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    placeholder="Email address" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input value="{{ $user->username }}"
                                    type="text"
                                    class="form-control"
                                    name="username"
                                    placeholder="Username" required>
                                @if ($errors->has('username'))
                                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control"
                                    name="role" required>
                                    <option value="">Selecione a regra</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ in_array($role->name, $userRole)
                                                ? 'selected'
                                                : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                    <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                                @endif
                            </div>

                            <div class="mb-3 form-check form-switch">
                                <label for="role" class="form-label">Status:</label>&emsp;&emsp;
                                <input id="status" type="hidden" name="status" 
                                    value="@if(!empty($record->status)) 1 @else 0 @endif">
                                <input class="form-check-input" type="checkbox"  [(ngModel)]="rememberMe"
                                    id="flexSwitchCheckDefault" {{ ($user->status == 1 ? 'checked' : '')}} 
                                    onclick="document.getElementById('status').value=this.checked?1:0">
                                    <span class="label-text">(Ativar/Desativar)</span> 
                                @if ($errors->has('status'))
                                    <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            <a href="{{ route('users.index') }}" class="btn btn-default">Voltar</button></a>
                        </form>
                    </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {
                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }
            });
        });
    </script>
@endsection
