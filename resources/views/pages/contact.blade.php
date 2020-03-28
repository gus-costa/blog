@extends('layouts.main')

@section('heading')
<div class="page-heading">
    <h1>Contact Me</h1>
    <span class="subheading">Have questions? I have answers.</span>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
        @if (Session::has('contact_sent'))
        <div class="alert alert-success" role="alert">{{ Session::get('contact_sent') }}</div>
        @endif
        @include('common.errors')
        <form method="POST" action="{{ route('submitContact') }}" id="contactForm" novalidate>
          @csrf
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" class="form-control" placeholder="Name" name="name" id="name" required data-validation-required-message="Please enter your name." value="{{ old('name') }}">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" name="email" id="email" required data-validation-required-message="Please enter your email address." value="{{ old('email') }}">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Message</label>
              <textarea rows="5" class="form-control" placeholder="Message" name="message" id="message" required data-validation-required-message="Please enter a message.">{{ old('message') }}</textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('scripts')
{{ Html::script('js/jqBootstrapValidation.js') }}
{{ Html::script('js/contact_me.js') }}
@endsection