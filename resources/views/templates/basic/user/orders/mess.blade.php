@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-12">
            <div class="card">
                <form action="{{ route('user.order.mass.store') }}" method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="form-group col-md-12">
                            <label class="fw-bold" for="mass_order">@lang('Place mass order (Press Enter button for every new order)')</label>
                            <textarea class="form-control" id="mass_order" name="mass_order" placeholder="service_id|link|quantity
service_id|link|quantity
service_id|link|quantity" cols="30" rows="10">{{ old('mess_order') }}</textarea>

                        </div>

                    </div>

                    <div class="card-footer">

                        <div class="form-group col-md-12 text-center">
                            <button class="btn btn--primary w-100 h-45 mr-2" type="submit">@lang('Submit')</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
