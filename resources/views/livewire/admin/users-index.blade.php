<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" class="form-control" placeholder="Ingrese nombre o correo del usuario">
        </div>
        <div class="card-body">
            <table class="table table-dark table-responsive table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th style="width: 45%">Nombre</th>
                        <th style="width: 45%">Email</th>
                        <th style="width: 10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->id }} </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                            <td>
                                <a class="btn btn-primary" href=" {{ route('admin.users.edit', $user) }} ">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{$users->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
