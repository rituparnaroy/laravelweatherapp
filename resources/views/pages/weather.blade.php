@extends('layouts.default')
@section('content')
        <div class="container">
            <div class="row row-content">
                <div class="col-12">
                    <form class="form-horizontal" method="POST" action="/">
                        @csrf
                        <div class="form-group">
                            <label for="city" class="control-label col-sm-2">City:</label>
                            <input type="text" name="city" placeholder="Enter city" class="@error('city') is-invalid @enderror col-sm-5" />
                            @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="countrycode" class="control-label col-sm-2">Country code:</label>
                            <input type="text" name="countrycode" placeholder="Enter 2-letter country code" class="@error('countrycode') is-invalid @enderror col-sm-5" />
                            @error('countrycode')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-default btn-success">Submit</button>
                    </form>
                </div>
                @if (!empty($avgTemperature)) 
                    <div class="col-12 ">
                        <h3>Average temperature of {{ $city }}, {{ $country }} for next 10 days is <mark> {{ $avgTemperature ?? '' }} </mark>&deg;c </h3>
                    </div>
                @endif
                @if (!empty($message)) 
                    <div class="col-12">
                        <h3 class="text-danger">{{ $message }}</h3>
                    </div>
                @endif
            </div>
            
        </div>
    @endsection