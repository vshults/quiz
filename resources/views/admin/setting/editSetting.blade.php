@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <style>.inp {
                width: 400px;
            }

            .content {
                margin-left: 10px;
            }

            .col-sm-6 {
                display: flex;
            }
            .prev {
                margin-left: 40%;
                margin-top: 0.5%
            }
            #json-input {
                display: block;
                width: 100%;
                height: 200px;
            }
            #translate {
                margin: 20px 0;
            }
            #json-display {
                border: 1px solid #000;
                margin: 0;
                padding: 10px 20px;
            }
        </style>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать FRONT</h1>
                        <a href="{{route('admin.hosts')}}">
                            <button class="btn btn-default prev">Назад</button>
                        </a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="form-group js-edit-setting">
                <textarea data-id="{{$id}}" data-name="properties"  id="json-input" autocomplete="off">{{$settings['text'] ?? '{}'}}</textarea>
                <br>
                <pre id="json-display"></pre>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
