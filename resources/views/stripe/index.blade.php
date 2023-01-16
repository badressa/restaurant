@if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<form method='POST'  action="{{ route('stripe.checkout') }}" >
    @csrf
    <button type="submit" > checkout </button>
</form>

