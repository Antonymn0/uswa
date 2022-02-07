<template>
   <div>
      <div class="modal fade" id="staticBackdropIntroVideo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content px-1">
            <div class="modal-header">
                <h4 class="modal-title fw-bold">Intro video</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
              <h6>Video</h6>
                <video width="320" height="240"  preload="true" controls>
                    <source src="/videos/video.mp4" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
               
              <div class="p-1 text-left">
                <button class="btn btn-success m-1">Message</button> 
               <button class="btn btn-danger m-1" data-bs-dismiss="modal" aria-label="Close">Close</button>  
              </div>           
            </div>            
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    methods:{
        playPauseVideo() {
            let videos = document.querySelectorAll("video");
            videos.forEach((video) => {
                // We can only control playback without insteraction if video is mute
                video.muted = false;
                // Play is a promise so we need to check we have it
                let playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.then((_) => {
                        let observer = new IntersectionObserver(
                            (entries) => {
                                entries.forEach((entry) => {
                                    if (
                                        entry.intersectionRatio !== 1 &&
                                        !video.paused
                                    ) {
                                        video.pause();
                                    } else if (video.paused) {
                                        video.play();
                                    }
                                });
                            },
                            { threshold: 0.2 }
                        );
                        observer.observe(video);
                    });
                }
            });
        }
    },
    mounted(){
       this.playPauseVideo()
    }

}
</script>

<style>

</style>