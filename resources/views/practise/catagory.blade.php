@extends('layouts.main')
@php
$side_bar_tops = json_decode($Side_Bar_Tops_Object, true);
@endphp
@section('extra-styles')
{{ HTML::style('css/simple-audio-player.css') }}
{{ HTML::style('css/checkbox.css') }}
{{ HTML::style('css/table.css') }}
@endsection

@section('content')
<section class="content">
    <table class="table table-bordered table-md-cell">
        <tbody>
            @foreach ($side_bar_tops['practise']['subsidiaries'][$category]['subsidiaries'] as $item)
            <tr>
                <td><a href="{{ $item['href'] }}">{{ ucfirst($item['name']) }}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection