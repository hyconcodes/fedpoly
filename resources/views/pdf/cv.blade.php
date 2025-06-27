<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $user->name }} - CV</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
            line-height: 1.6;
            margin: 20px;
        }
        h1, h2 {
            margin: 5px 0;
        }
        .section {
            margin-top: 20px;
        }
        .section-title {
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 5px;
        }
        .entry {
            margin-bottom: 10px;
        }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <h1>{{ $user->name }}</h1>
    <p>
        {{ $user->address }}<br>
        Phone: {{ $user->phone }}{{ $user->alt_phone ? ', ' . $user->alt_phone : '' }}<br>
        Email: {{ $user->email }}
    </p>

    {{-- <div class="section">
        <div class="section-title">Career Objective</div>
        <p>{{ $user->objective }}</p>
    </div> --}}

    <div class="section">
        <div class="section-title">Educational Background</div>
        <div class="entry">
            <span class="bold">{{ $education->institution }}</span><br>
            {{ $education->degree_level }} in {{ $education->field_of_study }} ({{ $education->graduation_date }})
        </div>
    </div>

    @if(!empty($publications))
    <div class="section">
        <div class="section-title">Publications</div>
        @foreach($publications as $publication)
        <div class="entry">
            <span class="bold">{{ $publication['title'] }}</span><br>
            {{ $publication['journal_conference'] }} ({{ $publication['publication_year'] }})<br>
            @if(!empty($publication['doi']))
            DOI: {{ $publication['doi'] }}
            @endif
        </div>
        @endforeach
    </div>
    @endif

    {{-- @if(!empty($user->certifications))
    <div class="section">
        <div class="section-title">Certifications</div>
        <p>{!! nl2br(e($user->certifications)) !!}</p>
    </div>
    @endif --}}

    {{-- @if(!empty($user->experience))
    <div class="section">
        <div class="section-title">Professional Experience</div>
        <p>{!! nl2br(e($user->experience)) !!}</p>
    </div>
    @endif --}}

    {{-- @if(!empty($user->skills))
    <div class="section">
        <div class="section-title">Skills</div>
        <p>{!! nl2br(e($user->skills)) !!}</p>
    </div>
    @endif

    @if(!empty($user->languages))
    <div class="section">
        <div class="section-title">Languages</div>
        <p>{!! nl2br(e($user->languages)) !!}</p>
    </div>
    @endif

    @if(!empty($user->hobbies))
    <div class="section">
        <div class="section-title">Hobbies and Interests</div>
        <p>{!! nl2br(e($user->hobbies)) !!}</p>
    </div>
    @endif

    @if(!empty($user->references))
    <div class="section">
        <div class="section-title">References</div>
        <p>{!! nl2br(e($user->references)) !!}</p>
    </div>
    @endif --}}
</body>
</html>