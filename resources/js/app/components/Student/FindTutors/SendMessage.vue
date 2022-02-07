<template>
  <div>
        <div class="modal fade" id="staticBackdropMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content px-3">
            <div class="modal-header">
                <h4 class="modal-title fw-bold">Message tutor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-2">
              <h6>Contact Antony,</h6>
              <small class="text-muted p-1">Introduce yourself to the tutor, share your learning goals and ask any questions</small>

              <textarea cols="30" rows="10" class="w-100 form-control p-2"></textarea>

              <div class="p-1 text-left">
                <button class="btn btn-primary m-1">Send</button> 
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

}
</script>

<style>

</style>