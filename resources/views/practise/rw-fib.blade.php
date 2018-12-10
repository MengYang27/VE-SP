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
      border: 1px solid;
    }

   td
   {
    border: 1px solid black;
    border-left: none;
    padding: 5px;
    margin: 20px;
    text-align: left;

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
   select
   {
       appearance: none;
       background-color: white;
       border: 1px solid;
   }
   option
   {
       background-color: white;
       border: 1px solid;
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
                        <!-- ./row -->
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $Question['Content'] !!}
                            </div>
                            <!-- ./col-xs-12 -->
                        </div>
                        <!-- ./row -->
                    </div>

                    <table>
                        <tbody>
                            <tr>
                                <td class="td"><button>Redo</button></td>
                                <td><button>Dictionary</button></td>
                            </tr>

                            <tr>
                                <td class="td"><input type="button" value="Show Answer" id="btnShowAnswer" /></td>
                                <td><input type="button" value="Show Hint" id="btnShowHint" /></td>
                            </tr>

                            <tr>
                                <td class="td"><button>Current Score</button></td>
                                <td><button>0/5</button></td>
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
                {{ $answer.', ' }}
                @endforeach
            </div>
            <div id="dHint" class="box" style="display:none">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <tbody>
                        @foreach ($Question['Hints'] as $hint)
                        <tr role="row" class="odd">
                            <td width="10%" nclass="sorting_1">{!! $hint[0] !!}</td>
                            <td width="15%">{!! $hint[1] !!}</td>
                            <td>{!! $hint[2] !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col-xs-12  -->
</section>
<!-- /.content -->
@endsection

@section('extra-scripts')
<script type="text/javascript">
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
    document.getElementById("btnShowHint").onclick = function () {
        var btnSW = document.getElementById("btnShowHint");
        var divAnswer = document.getElementById("dHint");
        if (btnSW.value == "Hide Hint") {
            document.getElementById("s1").style.backgroundColor = 'white';
            document.getElementById("s2").style.backgroundColor = 'white';
            document.getElementById("s3").style.backgroundColor = 'white';
            divAnswer.style.display = 'none';
            btnSW.value = "Show Hint";
        } else {
            document.getElementById("s1").style.backgroundColor = 'red';
            document.getElementById("s2").style.backgroundColor = 'red';
            document.getElementById("s3").style.backgroundColor = 'red';
            divAnswer.style.display = 'block';
            btnSW.value = "Hide Hint";
        }
    }
</script>
@endsection