<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha512-pax4MlgXjHEPfCwcJLQhigY7+N8rt6bVvWLFyUMuxShv170X53TRzGPmPkZmGBhk+jikR8WBM4yl7A9WMHHqvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        let notification_toggle = document.getElementsByClassName("notification_toggle");

        let notifications = document.getElementsByClassName("notification");

        for (let i = 0; i < notification_toggle.length; i++) {
            notification_toggle[i].addEventListener("click", () => {
                notifications[i].classList.add("hide");
                let index = i;
                setTimeout(() => {
                    notification[index].remove()
                }, 1000);
            })
        }

        let guides = document.getElementsByClassName("guide");

        for(let i = 0; i < guides.length; i++){
            guides[i].addEventListener("click", () => {
                guides[i].classList.add("hide");
            })
        }
    })
</script>