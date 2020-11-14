@extends('layouts.default')
@section('content')
        <div class="container">
            <div class="row row-content">
                <div class="col-12">
                    <form class="form-horizontal" method="POST" action="/">
                        @csrf
                        <div class="form-group">
                            <label for="city" class="control-label col-sm-2">City:</label>
                            <input type="text" name="city" placeholder="Enter city" class="@error('city') is-invalid @enderror col-sm-10" />
                            @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="countrycode" class="control-label col-sm-2">Country code:</label>
                            <input type="text" name="countrycode" placeholder="Enter 2-letter country code" class="@error('countrycode') is-invalid @enderror col-sm-10" />
                            @error('countrycode')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-default btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    @if (!empty($avgTemperature)) 
        <div class="container">
            <div class="row row-content">
                <div class="col-12">
                    Average temperature of {{ $city }}, {{ $country }} for next 10 days is {{ $avgTemperature ?? '' }} &deg;c
                </div>
            </div>    
        </div>
    @endif
    @if (!empty($message)) 
        <div class="container">
            <div class="row row-content">
                <div class="col-12">
                    {{ $message }}
                </div>
            </div>
        </div>
    @endif
    @endsection