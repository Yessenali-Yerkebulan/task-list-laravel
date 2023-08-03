<h1>The list of tasks</h1>


<div>
        @forelse($tasks as $task)
        <a href="{{ route('tasks.show', ['id'=>$task->id]) }}">{{ $task->title }}</a>
        @empty
            <div>There are no tasks!</div>
        @endforelse
</div>
