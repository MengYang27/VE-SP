@extends('layouts.main')

@php
$questions = $Questions_List_Object;
@endphp

@section('extra-styles')
{{ HTML::style('css/table-inherit.css') }}
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- .row  -->
        <div class="col-xs-12">
            <!-- .col-xs-12  -->
            <div class="box">
                <!-- .box -->
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- .box-body -->
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                    aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                                colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                colspan="1" aria-label="Browser: activate to sort column ascending">Question</th>
                                            <!-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Engine version</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">CSS grade</th>-->
                                        </tr>
                                    </thead>
                                    <tbody id="pagination_table">
                                        @foreach ($questions as $question)
                                        <tr role="row" class="odd">
                                            <td width="10%" nclass="sorting_1">{{ $question->id }}</td>
                                            <td><a href="/practise/{{ $category }}/{{ $Subclass }}/{{ $question->id }}">{{
                                                    $question->title }}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing
                                    {{ $questions->firstItem() }} to {{ $questions->lastItem() }} of {{
                                    $questions->total() }}
                                    entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    {{ $questions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col-xs-12  -->
    </div>
    <!-- ./row -->
</section>
<!-- /.content -->
@endsection