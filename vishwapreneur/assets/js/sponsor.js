let slidr = tns({
    container: ".vp-my-slider",
    "slideBy": "1",
    "speed": 90,
    "nav": false,
    autoplay: true,
    controls: false,
    autoplayButtonOutput: false,
    responsive: {
        1600: {
            items: 5,
            gutter: 70
        },
        1024: {
            items: 4,
            gutter: 70
        },
        768: {
            items: 3,
            gutter: 70
        },
        480: {
            items: 2,
            gutter: 70
        }
    }
})