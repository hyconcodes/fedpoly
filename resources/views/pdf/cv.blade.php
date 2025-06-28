<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $user->name ?? 'CV' }}</title>
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
    <h1>{{ $user->name ?? 'N/A' }}</h1>
    <p>
        {{ $user->address ?? 'N/A' }}<br>
        Phone: {{ $user->phone ?? 'N/A' }}<br>
        Email: {{ $user->email ?? 'N/A' }}<br>
        Gender: {{ $user->gender ?? 'N/A' }}<br>
        Nationality: {{ $user->nationality ?? 'N/A' }}<br>
        Date of Birth: {{ $user->dob ?? 'N/A' }}
    </p>

    <div class="section">
        <div class="section-title">Career Objective</div>
        <p>{{ $user->objective ?? 'N/A' }}</p>
    </div>

    @if(isset($education) && $education)
    <div class="section">
        <div class="section-title">Educational Background</div>
        <div class="entry">
            <span class="bold">{{ $education->institution ?? 'N/A' }}</span><br>
            {{ $education->degree_level ?? 'N/A' }} in {{ $education->field_of_study ?? 'N/A' }} ({{ $education->graduation_date ?? 'N/A' }})
        </div>
    </div>
    @endif

    @if(!empty($publications))
    <div class="section">
        <div class="section-title">Publications</div>
        @foreach($publications as $publication)
        <div class="entry">
            <span class="bold">{{ $publication['title'] ?? 'N/A' }}</span><br>
            {{ $publication['journal_conference'] ?? 'N/A' }} ({{ $publication['publication_year'] ?? 'N/A' }})<br>
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
        <p>{!! nl2br(e($user->certifications ?? '')) !!}</p>
    </div>
    @endif --}}

    {{-- @if(!empty($user->experience))
    <div class="section">
        <div class="section-title">Professional Experience</div>
        <p>{!! nl2br(e($user->experience ?? '')) !!}</p>
    </div>
    @endif --}}

    {{-- @if(!empty($user->skills))
    <div class="section">
        <div class="section-title">Skills</div>
        <p>{!! nl2br(e($user->skills ?? '')) !!}</p>
    </div>
    @endif

    @if(!empty($user->languages))
    <div class="section">
        <div class="section-title">Languages</div>
        <p>{!! nl2br(e($user->languages ?? '')) !!}</p>
    </div>
    @endif

    @if(!empty($user->hobbies))
    <div class="section">
        <div class="section-title">Hobbies and Interests</div>
        <p>{!! nl2br(e($user->hobbies ?? '')) !!}</p>
    </div>
    @endif

    @if(!empty($user->references))
    <div class="section">
        <div class="section-title">References</div>
        <p>{!! nl2br(e($user->references ?? '')) !!}</p>
    </div>
    @endif --}}
</body>
</html>