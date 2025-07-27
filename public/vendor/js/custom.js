document.addEventListener('DOMContentLoaded', function() {
    // Isotope Filtering for Courses
    const filterCardArea = document.querySelector("#filterCardArea");
    
    if (filterCardArea) {
        const gridArea = new Isotope(filterCardArea, {
            itemSelector: ".card-theme",
            layoutMode: "fitRows",
            stagger: 30,
            getSortData: {
                name: ".courseName",
                price: ".price",
                rating: ".rating",
            },
        });

        // Filter buttons functionality
        const filterButtons = document.querySelectorAll("#filterButtons a");
        
        filterButtons.forEach((filterBtn) => {
            filterBtn.addEventListener("click", (e) => {
                e.preventDefault();

                // Remove active class from all buttons
                filterButtons.forEach((btn) => {
                    btn.classList.add("bg-white");
                    btn.classList.remove("btn-secondary");
                });

                // Add active class to clicked button
                filterBtn.classList.remove("bg-white");
                filterBtn.classList.add("btn-secondary");

                // Filter the grid
                const filterValue = filterBtn.dataset.filter;
                gridArea.arrange({ filter: filterValue });
            });
        });
    }

    // Tiny Slider for Testimonies
    const testimoniesSlider = document.querySelector("#testimoniesSlider");
    
    if (testimoniesSlider) {
        const testSlider = tns({
            container: testimoniesSlider,
            items: 1,
            hasControls: false,
            autoplay: true,
            prevButton: "#testimoniesLeftArrow",
            nextButton: "#testimoniesRightArrow",
            autoplayHoverPause: true,
            autoplayTimeout: 3000,
            autoplayButtonOutput: false,
            nav: false,
            slideBy: 1,
            mouseDrag: true,
            loop: true,
            rewind: false,
            lazyload: true,
            responsive: {
                200: { items: 1 },
                400: { items: 1 },
                768: { items: 1 },
                992: { items: 1 },
                1200: { items: 1 },
            },
        });

        // Update slide counter
        const setInfoValue = () => {
            const sliderInfo = testSlider.getInfo();
            const currentSlideElement = document.querySelector("#currentSlide");
            const endSlideElement = document.querySelector("#endSlide");
            
            if (currentSlideElement) {
                currentSlideElement.innerText = sliderInfo.displayIndex;
            }
            if (endSlideElement) {
                endSlideElement.innerText = sliderInfo.slideCount;
            }
        };

        // Set initial values
        setInfoValue();

        // Update counter on navigation
        const leftArrow = document.querySelector("#testimoniesLeftArrow");
        const rightArrow = document.querySelector("#testimoniesRightArrow");
        
        if (leftArrow) {
            leftArrow.addEventListener("click", setInfoValue);
        }
        
        if (rightArrow) {
            rightArrow.addEventListener("click", setInfoValue);
        }
    }

    // Hide loading spinner
    const spanner = document.querySelector(".spanner");
    if (spanner) {
        spanner.classList.remove("show");
    }
}); 