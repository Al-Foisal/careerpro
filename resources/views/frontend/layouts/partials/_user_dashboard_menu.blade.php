<ul>
    <li>
        <a href="{{ route('user.dashboard') }}" class="{{ request()->is('user/dashboard') ? 'active' : '' }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('user.courses.courses') }}" class="{{ request()->is('user/courses') ? 'active' : '' }}"> My Courses</a>
    </li>
    <li>
        <a href="{{ route('user.courses.assignment') }}" class="{{ request()->is('user/courses/assignment') ? 'active' : '' }}"> Assignments</a>
    </li>
    {{-- <li>
        <a href="my-certificates.html" class="{{ request()->is('user/courses/exam') ? 'active' : '' }}">Certificates</a>
    </li> --}}
    <li>
        <a href="{{ route('user.courses.exam') }}" class="{{ request()->is('user/courses/exam') ? 'active' : '' }}"> Exam</a>
    </li>
    <li>
        <a href="{{ route('user.courses.result') }}" class="{{ request()->is('user/courses/result') ? 'active' : '' }}"> Result</a>
    </li>
    <li>
        <a href="{{ route('user.job.index') }}" class="{{ request()->is('user/job') ? 'active' : '' }}">Job</a>
    </li>
    <li>
        <a href="{{ route('user.profile.edit') }}" class="{{ request()->is('user/profile') ? 'active' : '' }}"> Profile</a>
    </li>
</ul>
