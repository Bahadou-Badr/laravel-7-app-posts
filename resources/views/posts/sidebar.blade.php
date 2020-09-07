
        <div class="card">
            
            <div class="card-body">
                <h4 class="card-title">Most Post Commented</h4>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($mostCommented as $post)
                <li class="list-group-item">
                    <a href="#">{{$post->title}}</a>
                    <p><span class="badge badge-success">{{ $post->comments_count }} comment (s)</span></p>
                </li>    
                @endforeach
            </ul>
        </div>

        <x-card
            title="Most Active Users"
            text="Most Users Post written"
            :items="collect($activeUsers)->pluck('name')">    
        </x-card>

        <x-card
            title="Most Active Users"
            text="Most Users Active In Last Month"
            :items="collect($activeUsersLastMonth)->pluck('name')">    
        </x-card>