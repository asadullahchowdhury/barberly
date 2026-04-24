<div id="preloader" class="preloader">
    <div class="manage-icon-position">
        <div class="spinner-loading-animation"></div>
        <div class="logo">
            <img src="{{asset('/images/global/preloader-logo.svg')}}" class="w-65" alt="scissor preloader">
        </div>
    </div>
</div>

<script>
    const loader = document.getElementById("preloader")

        window.addEventListener("load", function () {
            setTimeout(() => {
                loader.style.display = "none";
            },1000)
        })

</script>
