// page reload and add hero section animation
document.addEventListener("DOMContentLoaded", function () {
  const loader = document.getElementById("page-loader");

  window.addEventListener("load", () => {
    setTimeout(() => {
      loader.classList.add("opacity-0"); // Start fading out
      setTimeout(() => {
        loader.remove(); // Remove from DOM after fade-out
      }, 500); // Match this duration to the fade-out transition
    }, 300); // Initial load delay (optional)
  });
});


// Mobile menu toggle
const menuToggle = document.getElementById("menuToggle");
const closeMenu = document.getElementById("closeMenu");
const mobileMenu = document.getElementById("mobileMenu");
const mobileAbout = document.getElementById("mobileAbout");
const aboutDropdown = document.getElementById("aboutDropdown");
const mobileServices = document.getElementById("mobileServices");
const servicesDropdown = document.getElementById("servicesDropdown");

menuToggle.addEventListener("click", () => {
  mobileMenu.classList.remove("-translate-x-full");
});

closeMenu.addEventListener("click", () => {
  mobileMenu.classList.add("-translate-x-full");
});

mobileAbout.addEventListener("click", () => {
  aboutDropdown.classList.toggle("hidden");
  aboutDropdown.classList.toggle("block");
});

mobileServices.addEventListener("click", () => {
  servicesDropdown.classList.toggle("hidden");
  servicesDropdown.classList.toggle("block");
});





// Carousel Data
const slides = [
  {
    image: "assets/img/hero-1.jpg",
    heading: "Heading 1",
    content: "Content for the first image goes here."
  },
  {
    image: "assets/img/hero-2.jpeg",
    heading: "Heading 2",
    content: "Content for the second image goes here."
  },
  {
    image: "assets/img/hero-3.jpeg",
    heading: "Heading 3",
    content: "Content for the third image goes here."
  },
  {
    image: "assets/img/hero-4.jpeg",
    heading: "Heading 4",
    content: "Content for the fourth image goes here."
  }
];

let currentIndex = 0;

const fadeLayer = document.getElementById("fade-layer");
const carouselImage = document.getElementById("carousel-image");
const carouselHeading = document.getElementById("carousel-heading");
const carouselContent = document.getElementById("carousel-content");
const prevSlide = document.getElementById("prev-slide");
const nextSlide = document.getElementById("next-slide");

// Function to update slide
function updateSlide(index) {
  fadeLayer.classList.add("opacity-100");

  setTimeout(() => {
    // Update content and image
    carouselImage.style.backgroundImage = `url(${slides[index].image})`;
    carouselHeading.textContent = slides[index].heading;
    carouselContent.textContent = slides[index].content;

    fadeLayer.classList.remove("opacity-100");
  }, 500); // Sync with fade duration

  currentIndex = index;
}

// Auto Slide
const autoSlide = setInterval(() => {
  const nextIndex = (currentIndex + 1) % slides.length;
  updateSlide(nextIndex);
}, 5000);

// Add click events to navigation arrows
prevSlide.addEventListener("click", () => {
  clearInterval(autoSlide);
  const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
  updateSlide(prevIndex);
});

nextSlide.addEventListener("click", () => {
  clearInterval(autoSlide);
  const nextIndex = (currentIndex + 1) % slides.length;
  updateSlide(nextIndex);
});

// Initial Load
updateSlide(currentIndex);






// contact_form 


document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("contactForm")
    .addEventListener("submit", function (e) {
      // Prevent form submission initially
      e.preventDefault();

      // Clear previous error messages
      let errors = false;

      // Validate Full Name
      let name = document.getElementById("name").value;
      let nameError = document.getElementById("nameError");
      if (name.length < 3) {
        nameError.classList.remove("hidden");
        errors = true;
      } else {
        nameError.classList.add("hidden");
      }

      // Validate Email
      let email = document.getElementById("email").value;
      let emailError = document.getElementById("emailError");
      let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
      if (!emailPattern.test(email)) {
        emailError.classList.remove("hidden");
        errors = true;
      } else {
        emailError.classList.add("hidden");
      }

      // Validate Phone
      let phone = document.getElementById("phone").value;
      let phoneError = document.getElementById("phoneError");
      if (!/^\d{10}$/.test(phone)) {
        phoneError.classList.remove("hidden");
        errors = true;
      } else {
        phoneError.classList.add("hidden");
      }

      // Validate Message
      let message = document.getElementById("message").value;
      let messageError = document.getElementById("messageError");
      if (message.trim() === "") {
        messageError.classList.remove("hidden");
        errors = true;
      } else {
        messageError.classList.add("hidden");
      }

      // If no errors, submit the form
      if (!errors) {
        this.submit();
      }
    });
});

