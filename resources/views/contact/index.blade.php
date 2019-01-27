@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Contacts') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <p class="contact-menu">
                          <a class="btn btn-link" data-toggle="collapse" href="#list" role="button" aria-expanded="true" aria-controls="list">
                            List
                          </a>
                          <a class="btn btn-link" data-toggle="collapse" href="#new-contact" role="button" aria-expanded="false" aria-controls="new-contact">
                            New Contact
                          </a>
                          <a class="btn btn-link" data-toggle="collapse" href="#blocked-list" role="button" aria-expanded="false" aria-controls="blocked-list">
                            Blocked List
                          </a>
                          <a class="btn btn-link" data-toggle="collapse" href="#request" role="button" aria-expanded="false" aria-controls="blocked-list">
                            Request
                          </a>
                          <a class="btn btn-link" data-toggle="collapse" href="#explore" role="button" aria-expanded="false" aria-controls="explore">
                            Explore
                          </a>
                        </p>

                        <div class="contact-content collapse show" id="list">
                          <div class="card card-body">
                             @include('contact.partials._list')
                          </div>
                        </div>
                        <div class="contact-content collapse" id="new-contact">
                          <div class="card card-body">
                            @include('contact.partials._new_contact')
                          </div>
                        </div>
                        <div class="contact-content collapse" id="blocked-list">
                          <div class="card card-body">
                            @include('contact.partials._blocked_list')
                          </div>
                        </div>
                        <div class="contact-content collapse" id="request">
                          <div class="card card-body">
                            @include('contact.partials._request')
                          </div>
                        </div>
                        <div class="contact-content collapse" id="explore">
                          <div class="card card-body">
                            @include('contact.partials._explore')
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
