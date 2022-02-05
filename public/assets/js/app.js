const cardData = {
    0: {
      "title": "Awesome Card Title",
      "content": "Courtesy of ES6 Template Literals."
    },
    1: {
      "title": "Amazing Things with ES6",
      "content": "An exploration of ES6 Template Literals."
    },
    2: {
      "title": "Thinking about cards",
      "content": "With Bulma and ES6 of course."
    },
  };
  
  function renderCard(selector="#cards", data) {
    
    const cardTemplate = 
    `
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          ${data.title}
        </p>
        <a href="#" class="card-header-icon" aria-label="more options">
          <span class="icon">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
          </span>
        </a>
      </header>
      <div class="card-content">
        <div class="content">
          ${data.content}
        </div>
      </div>
      <footer class="card-footer">
      <a href="#" class="card-footer-item">Save</a>
      <a href="#" class="card-footer-item">Edit</a>
      <a href="#" class="card-footer-item">Delete</a>
    </footer>
    </div>
    `;
    
    document.querySelector(selector).insertAdjacentHTML('beforeend', cardTemplate);
      
  }
  
  for (const [key, value] of Object.entries(cardData)) {
    renderCard('#cards', cardData[key]);
  }
  