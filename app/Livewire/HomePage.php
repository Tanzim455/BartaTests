<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use App\Models\UserPostLike;
use App\Notifications\LikeNotification;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;
    public int $page=1;
   
    
    public int $perPage=10;
    public $counter=0;
    public $isLiked;
     
    use WithPagination;
   
    public function likeStatus($id)
    { 
       
         $postId=Post::findOrFail($id)->id;
        //   dd($postId);
        

         $postLikeId=UserPostLike::where('post_id',$postId)
         ->where('user_id',auth()?->user()->id)
         
         ->exists();
         
         $likedPost=UserPostLike::where('post_id',$postId)
         ->where('user_id',auth()?->user()->id)->first();
         
        
        
          
       
        if($postLikeId){
            
            $likedPost->delete();
        
        }
        if(!$postLikeId){
            
            $like=UserPostLike::create([
                'user_id'=>auth()?->user()?->id,
                 'post_id'=>$postId,
                 
             ]);
            
             $post=Post::findOrFail($like->post_id);
             $user=User::findorFail($like->user_id);
        
             if($post->user_id !== auth()?->user()->id){
                $post->user->notify(new LikeNotification($post, $user));
            }
        // dd("Post is not liked");
            }
        
        
        
    }
    public function render()
    {
       
        

        
        
        return view('livewire.home-page',[
            'posts'=>Post::withUserDetails()
            ->withCount('likedPosts')
            
            ->latest()->paginate($this->perPage, ['*'], 'page', $this->page)
        ]);
        
    }
  

}
