@extends('Layouts.app')

@section('content')

    <div style="margin-top: 500px;">
        <h2 class="my-result">
            We have fold <strong style="color: green">{{count($aResults)}}</strong> Packages
        </h2>
        @include('Form.Form')

        @if(!empty($aResults) && is_array($aResults))
            <table style="margin-top: 20px;">
                <tr>
                    <th>Name</th>
                    <th>description</th>
                    <th>last version</th>
                    <th> downloads (total, monthly, daily)</th>
                </tr>
                @foreach($aResults as $aResult)
                    <tr>
                        <td>{{$aResult->name}}</td>
                        <td>{{$aResult->description}}</td>
                        <td>{{$aResult->repository}}</td>
                        <td>{{$aResult->downloads}}, {{$aResult->favers}}, {{$aResult->total}}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <h1 style="color: darkred">No result fold with ( {{$_GET['packageName']}} )</h1>
        @endif
    </div>

@endsection