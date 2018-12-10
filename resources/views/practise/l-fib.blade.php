@extends('layouts.main')
@php
$Question = json_decode($Question_Object, true);
@endphp

@section('extra-styles')
<style>
    input[type="text"]
        {
          width: 80px;
          background-color: white;
          border: 1px solid black;
        }
    
       td
       {
        border: 1px solid black;
        border-left: none;
        padding: 5px;
        margin: 20px;
        text-align: center;
    
       }
       .td
       {
         border: 1px solid black;
         padding: 5px;
         margin: 20px;
         text-align: center;
       }
       .td1
       {
         border: none;
       }
       table
       {
         border-collapse: separate;
         border-spacing: 0px 10px;
       }
       td.hover
       {
         cursor: pointer;
       }
       input[type="button"]
       {
         outline: none;
         border: 0;
         background-color: white;
       }
       button
       {
         outline: none;
         border: 0;
         background-color: white;
       }
        </style>
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
                    <h3 class="box-title">{{ $Question['Title'] }}</h3>
                    <table class="pull-right">
                        <tr>
                            @foreach ($Question['Tags'] as $tag => $tag_class)
                            <td class="td1">
                                <div class="{{ $tag_class }}">
                                    {{ $tag }}
                                </div>
                            </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-xs-12">
                                <h5>{{ $Question['Subtitle'] }}</h5>
                                <div class="row is-table-row">
                                    <audio controls>
                                        <source src="{{ URL::to('/').$Question['Audio']['Src']}}" type="{{ $Question['Audio']['Format']}}">
                                    </audio>
                                </div>
                            </div>
                            <!-- ./col-xs-12 -->
                        </div>
                        <!-- ./row -->
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $Question['Content'] !!}
                            </div>
                            <!-- ./col-xs-12 -->
                        </div>
                        <!-- ./row -->
                    </div>

                    <!-- buttons -->
                    <table>
                        <tbody>
                            <tr>
                                <td class="td">
                                    <button>Redo</button>
                                </td>
                                <td>
                                    <button>Dictionary</button>
                                </td>
                                <td>
                                    <button>Grammar</button>
                                </td>
                            </tr>

                            <tr>
                                <td class="td"><input type="button" value="Show Answer" id="btnShowAnswer" /></td>
                            </tr>
                            <tr>
                                    @for ($i = 0; $i < sizeof($Question['Options']); $i++)
                                    <td class="{{ $i==0? 'td' : '' }}">
                                        <button>{{ $Question['Options'][$i] }}</button>
                                    </td>
                                    @endfor
                            </tr>
                            <tr>
                                <td class="td">Current Score</td>
                                <td>0/5</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- endbuttons -->
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button" id="example2_previous">
                                        <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">
                                            <-Previous</a> </li> <li class="paginate_button next" id="example2_next">
                                                <a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next-></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div id="dAnswer" class="box" style="display:none">
                @foreach ($Question['Answers'] as $answer)
                {{ $answer }}
                @endforeach
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col-xs-12  -->
</section>
<!-- /.content -->
@endsection
@section('extra-scripts')
<script>
    document.getElementById("btnShowAnswer").onclick = function () {
        var btnSW = document.getElementById("btnShowAnswer");
        var divAnswer = document.getElementById("dAnswer");
        if (btnSW.value == "Hide Answer") {
            divAnswer.style.display = 'none';
            btnSW.value = "Show Answer";
        } else {
            divAnswer.style.display = 'block';
            btnSW.value = "Hide Answer";
        }
    }
</script>
@endsection