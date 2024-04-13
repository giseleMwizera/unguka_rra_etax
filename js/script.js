document.querySelector(".reg").addEventListener("submit", async function (event) {
  // event.preventDefault();
  var formData = new FormData(this);
  var xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "http://10.22.99.100/unguka_rra/controllers/bp_register.php",
    true
  );
  xhr.onload = function () {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      const userForm = document.querySelector(".reg");
      const title = userForm.querySelector(".title");
      title.textContent = response.responseMessage;
      title.style.color = "red";

      console.log(response);
    }
  };
  xhr.send(formData);
});

// let userCount = 2;

// const userForm = document.querySelector(".reg");
// const payerForm = document.querySelector(".pay");
// const addUserBtn = document.querySelector(".addBtn");
// const inquireBtn = document.querySelector(".inquireBtn");
// const nextBtn = document.querySelector(".nextBtn");

// const userFieldsContainer = document.getElementById("userFieldsContainer");
// const userList = document.getElementById("userList");
// let users = [];
// let payments = [];

// addUserBtn.addEventListener("click", function () {
//   const newUserFields = createUserFields();

//   // Add fields to the view
//   const breaker = document.createElement("hr");
//   const number = document.createElement("header");
//   const span = document.createElement("div");
//   span.setAttribute("class", "title");
//   span.style.margin = "30px";
//   number.textContent = `User ${userCount}:`;

//   userFieldsContainer.appendChild(breaker);
//   userFieldsContainer.appendChild(number);
//   userFieldsContainer.appendChild(span);
//   userFieldsContainer.appendChild(newUserFields);

//   userCount++;
// });

// nextBtn.addEventListener("click", () => {
//   allInput.forEach((input) => {
//     if (input.value != "") {
//       payerForm.classList.add("secActive");
//     } else {
//       payerForm.classList.remove("secActive");
//     }
//   });
// });

// //   backBtn.addEventListener("click", () => form.classList.remove("secActive"));

// payerForm.addEventListener("submit", async function (event) {
//   event.preventDefault();
//   let { responseCode, responseMessage, responseObject } = await getDocDetails(
//     event
//   );

//   const fieldsList = payerForm.querySelectorAll(".fields-py");

//   const declarationDate = responseObject.DeclarationDate;

//   const dateParts = declarationDate.split(" ")[0].split("/");
//   const year = dateParts[2];
//   const month = dateParts[1].padStart(2, "0");
//   const day = dateParts[0].padStart(2, "0");

//   const formattedDate = `${year}-${month}-${day}`;

//   if (responseCode == 0) {
//     event.preventDefault();
//     const title = userForm.querySelector(".title");
//     title.textContent = responseMessage;
//     title.style.color = "red";
//     title.style.fontWeight = "bold";

//     console.log(responseObject);
//   } else {
//     event.preventDefault();
//     const title = payerForm.querySelector(".title");
//     title.textContent = responseMessage;
//     title.style.color = "green";
//     const fields = payerForm.querySelectorAll(".fields");

//     fields.forEach(function (fields) {
//       const names = fields.querySelector('input[name="payerName"]');
//       names.value = responseObject.Names;

//       const rraRef = fields.querySelector('input[name="RRAref"]');

//       rraRef.value = responseObject.RraRef;

//       const tcDesc = fields.querySelector('input[name="tcDesc"]');

//       tcDesc.value = responseObject.TaxCenterDescription;

//       const tCenter = fields.querySelector('input[name="tCenter"]');

//       tCenter.value = responseObject.TaxCenter;

//       const tType = fields.querySelector('input[name="tType"]');

//       tType.value = responseObject.TaxType;

//       const ttyDesc = fields.querySelector('input[name="ttyDesc"]');

//       ttyDesc.value = responseObject.TaxTypeDescription;

//       const decId = fields.querySelector('input[name="decId"]');

//       decId.value = responseObject.DecId;

//       const tin = fields.querySelector('input[name="tin"]');

//       tin.value = responseObject.Tin;

//       const decDateInput = document.querySelector('input[name="decDate"]');

//       decDateInput.value = formattedDate;

//       const amt = fields.querySelector('input[name="amt"]');

//       amt.value = responseObject.Amount;

//       const origNum = fields.querySelector('input[name="origNum"]');

//       origNum.value = responseObject.RRAOrginNumber;

//       const assessNo = fields.querySelector('input[name="assessNo"]');

//       assessNo.value = responseObject.AssessmentNumber;

//       // users.push({ names, account, tin, number, nid, currency, email });
//     });
//   }
// });

// userForm.addEventListener("submit", async function (event) {

//   event.preventDefault();

//   var formData = new FormData(this);

//   var xhr = new XMLHttpRequest();
//   xhr.open(
//     "POST",
//     "http://10.22.99.100/unguka_rra/controllers/bp_register.php",
//     true
//   );
//   xhr.onload = function () {
//     if (xhr.status === 200) {
//       var response = JSON.parse(xhr.responseText);
//       const title = userForm.querySelector(".title");
//       title.textContent = response.responseMessage;
//       title.style.color = "red";
//     }
//   };
//   xhr.send(formData);
// });

// function createUserFields() {
//   const userFieldsDiv = document.createElement("div");
//   userFieldsDiv.classList.add("fields");

//   const inputFields = [
//     {
//       label: "Names",
//       type: "text",
//       name: "names[]",
//       placeholder: "Type in the tax payer names",
//       required: true,
//     },

//     {
//       label: "Account",
//       type: "text",
//       name: "account[]",
//       placeholder: "Type in the tax payer account",
//       required: true,
//     },

//     {
//       label: "Tin",
//       type: "text",
//       name: "tin[]",
//       placeholder: "Type in the tax payer TIN",
//       required: true,
//     },

//     {
//       label: "Phone Number",
//       type: "number",
//       name: "number[]",
//       placeholder: "Type in the tax payer number",
//       required: true,
//     },

//     {
//       label: "Currency",
//       type: "select",
//       name: "currency[]",
//       required: true,
//       id: "currency",
//       options: ["Select currency", "USD", "GBP", "RWF"],
//     },

//     {
//       label: "National ID",
//       type: "number",
//       name: "NID[]",
//       placeholder: "Type in the tax payer ID",
//       required: true,
//     },

//     {
//       label: "Email",
//       type: "email",
//       name: "email[]",
//       placeholder: "Type in the tax payer email",
//     },
//   ];

//   inputFields.forEach((field) => {
//     const inputField = document.createElement("div");
//     inputField.classList.add("input-field");
//     if (field.type === "select") {
//       const selectField = document.createElement("select");
//       selectField.setAttribute("name", field.name);
//       selectField.setAttribute("id", field.id);
//       field.options.forEach((option) => {
//         const optionElement = document.createElement("option");
//         optionElement.textContent = option;
//         selectField.appendChild(optionElement);
//       });
//       inputField.appendChild(selectField);
//     } else {
//       const inputElement = document.createElement("input");
//       inputElement.setAttribute("type", field.type);
//       inputElement.setAttribute("name", field.name);
//       inputElement.setAttribute("placeholder", field.placeholder);
//       if (field.required) {
//         inputElement.setAttribute("required", "true");
//       }
//       inputField.appendChild(inputElement);
//     }
//     if (field.label) {
//       const labelElement = document.createElement("label");
//       labelElement.textContent = field.label;
//       inputField.insertBefore(labelElement, inputField.firstChild);
//     }
//     userFieldsDiv.appendChild(inputField);
//   });

//   return userFieldsDiv;
// }

// async function getDocDetails(event) {
//   event.preventDefault();

//   // Extracting form data to construct the URL
//   const formData = new FormData(event.target);
//   const urlParams = new URLSearchParams(formData);

//   const url = `${event.target.action}?${urlParams.toString()}`;

//   const response = await fetch(url, {
//     method: "GET",
//   });

//   if (!response.ok) {
//     throw new Error("Network response was not ok");
//   }

//   const data = await response.json();
//   const responseCode = data.MessageCode;
//   const responseMessage = data.MessageDescription;
//   const responseObject = data.ResponseObject;

//   console.log("here", responseCode, responseMessage, responseObject);

//   return { responseCode, responseMessage, responseObject };
// }

// async function submitForm(event) {
//   const formData = new FormData(event.target);
//   const response = await fetch(event.target.action, {
//     method: "POST",
//     body: formData,
//   });

//   if (!response.ok) {
//     throw new Error("Network response was not ok");
//   }

//   const data = await response.text();
//   const parsedResponse = JSON.parse(data);
//   const responseArray = parsedResponse.ResponseObject;
//   let responseCode;
//   let responseMessage;
//   responseArray.forEach((item) => {
//     responseCode = item.MessageCode;
//     responseMessage = item.MessageDescription;

//     console.log("MessageCode:", item.MessageCode);
//     console.log("MessageDescription:", item.MessageDescription);
//     console.log("RequestId:", item.RequestId);
//     console.log("Tin:", item.Tin);
//   });
//   console.log("here", responseCode, responseMessage);
//   return { responseCode, responseMessage };
// }
