var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
  });


  const images = [
    "../images/images-20-12/466778101_586329664339244_4840710739078878333_n.jpg",
    "../images/images-20-12/466973108_586329957672548_205638269316799444_n.jpg",
    "../images/images-20-12/467184110_586330257672518_5689163726826900948_n.jpg",
    "../images/images-20-12/467187009_586329687672575_565846474625476398_n.jpg",
    "../images/images-20-12/467187538_586330177672526_1938628475129028830_n.jpg",
    "../images/images-20-12/467199205_586330197672524_3677730821411612294_n.jpg",
    "../images/images-20-12/467230229_586329754339235_474685674770402134_n.jpg",
    "../images/images-20-12/467267258_586330227672521_111894937887673188_n.jpg",
    "../images/images-20-12/467308585_586330291005848_1629326334762723658_n.jpg",
    "../images/images-20-12/467312055_586330031005874_6510538183256169514_n.jpg",
    "../images/images-20-12/467322513_586330067672537_2568673320388482555_n.jpg",
    "../images/images-20-12/467394477_586329891005888_7418764600674240871_n.jpg",
    "../images/images-20-12/467441196_586329924339218_1024244440692190663_n.jpg",
    "../images/images-20-12/467504924_586329874339223_6853727914706255737_n.jpg",
    "../images/images-20-12/467510350_586329991005878_4235687203753932875_n.jpg",
    "../images/images-20-12/467675722_586330137672530_4965267321176163596_n.jpg",
  ];
  
  const previewContainer = document.querySelector(".image-preview-container");
  const modal = document.getElementById("imageModal");
  const modalContent = modal.querySelector(".modal-content");
  const closeModal = modal.querySelector(".close");
  const fullImageViewer = document.getElementById("fullImageViewer");
  const fullImage = document.getElementById("fullImage");
  const closeFullImageViewer = fullImageViewer.querySelector(".close");
  const selectAllCheckbox = document.getElementById("selectAll");
  const downloadButton = document.getElementById("downloadButton");
  
  // Add CSS for selected images
  const style = document.createElement("style");
  style.innerHTML = `
    .selected img {
      border: 3px solid green;
      filter: brightness(0.7);
    }
    .selected::after {
      content: "✓";
      position: absolute;
      top: 10px;
      right: 10px;
      color: white;
      font-size: 20px;
      font-weight: bold;
      background: green;
      border-radius: 50%;
      padding: 5px;
    }
  `;
  document.head.appendChild(style);
  
  // Load preview images
  images.slice(0, 4).forEach((image) => {
    const imgElement = document.createElement("img");
    imgElement.src = image;
    imgElement.alt = "Preview Image";
    imgElement.style.width = "100%";
    imgElement.style.borderRadius = "10px";
    previewContainer.appendChild(imgElement);
  });
  
  // Open Modal
  previewContainer.parentElement.addEventListener("click", () => {
    modal.style.display = "block";
    modalContent.innerHTML = ""; // Clear modal content
  
    images.forEach((image) => {
      const wrapper = document.createElement("div");
      wrapper.style.position = "relative";
  
      const imgElement = document.createElement("img");
      imgElement.src = image;
      imgElement.alt = "Full Image";
      imgElement.style.width = "100%";
      imgElement.style.borderRadius = "5px";
      imgElement.style.cursor = "pointer";
  
      wrapper.appendChild(imgElement);
      modalContent.appendChild(wrapper);
  
      // Open full-size viewer on double click
      imgElement.addEventListener("dblclick", () => {
        fullImage.src = image;
        fullImageViewer.style.display = "flex";
      });
  
      // Toggle selection for download
      wrapper.addEventListener("click", () => {
        wrapper.classList.toggle("selected");
        updateSelectAllCheckboxState();
      });
    });
  });
  
  // Close Modal
  closeModal.addEventListener("click", () => {
    modal.style.display = "none";
  });
  
  // Close Full-Size Viewer
  closeFullImageViewer.addEventListener("click", () => {
    fullImageViewer.style.display = "none";
  });
  
  // Select All functionality
  selectAllCheckbox.addEventListener("change", () => {
    const wrappers = modalContent.querySelectorAll("div");
    wrappers.forEach((wrapper) => {
      if (selectAllCheckbox.checked) {
        wrapper.classList.add("selected");
      } else {
        wrapper.classList.remove("selected");
      }
    });
  });
  
  // Update Select All Checkbox state
  function updateSelectAllCheckboxState() {
    const wrappers = modalContent.querySelectorAll("div");
    const selected = modalContent.querySelectorAll("div.selected");
    const allSelected = selected.length === wrappers.length;
  
    // Update the Select All checkbox only if all images are selected
    selectAllCheckbox.checked = allSelected;
    selectAllCheckbox.indeterminate =
      selected.length > 0 && selected.length < wrappers.length;
  }
  
  // Download Selected Images
  downloadButton.addEventListener("click", () => {
    const selectedImages = modalContent.querySelectorAll("div.selected img");
    selectedImages.forEach((img) => {
      const link = document.createElement("a");
      link.href = img.src;
      link.download = img.src.split("/").pop();
      link.click();
    });
  });
  
  const graduImages = [
    "../images/Gradu/459059841_531146213190923_1134073327617787388_n.jpg",
    "../images/Gradu/459116342_531146266524251_8203334435084833427_n.jpg",
    "../images/Gradu/459126871_531146399857571_5543902198405298847_n.jpg",
    "../images/Gradu/459140901_531146526524225_2412229852969245621_n.jpg",
    "../images/Gradu/459141982_531144849857726_1975303567719995902_n.jpg",
    "../images/Gradu/459162947_531146549857556_8404723088665221295_n.jpg",
    "../images/Gradu/459171088_531146349857576_2939552541023264139_n.jpg",
    "../images/Gradu/459226937_531146756524202_245010540805816948_n.jpg",
    "../images/Gradu/459232394_531146636524214_3848504480336115192_n.jpg",
    "../images/Gradu/459269106_531146449857566_4247551867836785254_n.jpg",
    
];

// Update the previewContainer selector to target the Gradu card
const previewContainerGradu = document.querySelector("#Gradu .image-preview-container");

// Load preview images for the Gradu card
graduImages.slice(0, 4).forEach((image) => {
    const imgElement = document.createElement("img");
    imgElement.src = image;
    imgElement.alt = "Preview Image";
    imgElement.style.width = "100%";
    imgElement.style.borderRadius = "10px";
    previewContainerGradu.appendChild(imgElement);
});

// Open Modal for Gradu card
document.querySelector("#Gradu .image-gallery").addEventListener("click", () => {
    modal.style.display = "block";
    modalContent.innerHTML = ""; // Clear modal content

    graduImages.forEach((image) => {
        const wrapper = document.createElement("div");
        wrapper.style.position = "relative";

        const imgElement = document.createElement("img");
        imgElement.src = image;
        imgElement.alt = "Full Image";
        imgElement.style.width = "100%";
        imgElement.style.borderRadius = "5px";
        imgElement.style.cursor = "pointer";

        wrapper.appendChild(imgElement);
        modalContent.appendChild(wrapper);

        // Open full-size viewer on double click
        imgElement.addEventListener("dblclick", () => {
            fullImage.src = image;
            fullImageViewer.style.display = "flex";
        });

        // Toggle selection for download
        wrapper.addEventListener("click", () => {
            wrapper.classList.toggle("selected");
            updateSelectAllCheckboxState();
        });
    });
});


