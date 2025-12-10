@extends('layout.app')
@section('content')
    <div class="container">
        <div class="p-5 mb-4 bg-light rounded-3">
            <h3>Stop Managing Tasks. Start Finishing Them</h3>
            <p>The Smart To-Do Manager uses AI to organize, prioritize, and schedule your tasks so you can clear your list and reclaim your time.</p>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('img/tasks.png') }}">
                </div>
                <div class="col-md-8">
                    <h4>🌟 Why Use a Smart Task Manager?</h4>
                    <p>
                     <ul>
                        <li>🧠 Cognitive Freedom</li>
                        <li>🎯 Clarity and Focus</li>
                        <li>⏱️ Automated Efficiency</li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

