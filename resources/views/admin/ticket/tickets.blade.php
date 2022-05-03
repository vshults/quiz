@extends('admin.layouts.layout')

@section('content')

    <style>.btn_delete{margin-left: 30%;margin-right: auto}</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Заявки</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="info-box-content">
                <span class="info-box-text">Количество заявок</span>
                <span class="info-box-number">{{$count}}</span>
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Домены</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    @if($hosts)
                                        @foreach($hosts as $host)
                                            @foreach($counts as $k => $value)
                                                @if($k === $host['domen'])
                                                    <li class="nav-item active">
                                                        <a href="?host={{$host['id']}}" class="nav-link" style="cursor: pointer">
                                                            <i class="fas fa fa-laptop"></i>{{$host['domen']}}
                                                            <span class="badge bg-primary float-right">{{$value}}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Сортировка</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a  href="?sort=all" class="nav-link">
                                            <i class="far fa-circle text-secondary"></i>
                                            Все
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?sort=completed" class="nav-link">
                                            <i class="far fa-circle text-success"></i>
                                            Завершенные до конца
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?sort=unfinished" class="nav-link">
                                            <i class="far fa-circle text-danger"></i> Брошенные
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Заявки</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="mailbox-controls">
                                    <div class="float-right">
                                        <div class="btn-group">
                                            {{$tickets->appends(['sort' => request()->sort,'host' =>request()->host ])->links('vendor.pagination.bootstrap-4')}}
                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.float-right -->
                                </div>
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        @if($tickets)
                                            @foreach($tickets as $ticket)
                                                <tr>
                                                    <td class="mailbox-star">№{{$ticket->id}}</td>
                                                    <td class="mailbox-star"><a href="#"><i class="fas fa-star {{!empty($ticket->name) ? 'text-success' : 'text-danger'}}"></i></a></td>
                                                    <td class="mailbox-name"><a href="ticket/{{$ticket['id']}}">{{!empty($ticket->name) ? $ticket->name : 'Без имени'}}</a></td>
                                                    <td class="mailbox-subject"><b>{{$ticket->phone}}</b>
                                                    </td>
                                                    <td class="mailbox-date">{{!empty($ticket->updated_at) ? $ticket->updated_at : $ticket->created_at}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    </div>
@endsection
