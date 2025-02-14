@extends('layouts.admin')
@section('title','Shipping Method')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <form>
                <!-- Status Section -->
                <div class="mb-6 form-check">
<div>
    <label >Status</label>

</div>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" >
                    <label class="form-check-label" for="exampleCheck1">Lable Local Packup</label>
                </div>

                <!-- Label Section -->
                <div class="mb-6">
                    <label for="label" class="form-label">Label</label>
                    <input type="text" class="form-control" id="label" value="{{$shippingMethed->value}}" placeholder="Enter label" aria-describedby="labelHelp">
                    <small id="labelHelp" class="form-text text-muted">Provide a label for the local pickup service.</small>
                </div>

                <!-- Cost Section -->
                <div class="mb-6">
                    <label for="cost" class="form-label">Cost</label>
                    <input type="number" class="form-control" id="cost" value="Enter cost">
                    <small id="costHelp" class="form-text text-muted">Enter the cost associated with the local pickup.</small>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

            </div>
            <!-- Active Orders -->
        </div>
    </div>
</div>
@stop
