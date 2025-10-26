$(function () {

   /* ===== Imagen destacada (preview) ===== */
   const $cInput = $("#commerceImage");
   const $cThumb = $("#commerceThumb");
   if ($cInput.length && $cThumb.length) {
      $cInput.on("change", function (e) {
         const file = e.target.files && e.target.files[0];
         if (!file) return;
         const allowed = ["image/jpeg", "image/png", "image/webp"];
         const maxBytes = 2 * 1024 * 1024;
         if (!allowed.includes(file.type)) { this.value = ""; alert("Formato no permitido. Usa JPG, PNG o WEBP."); return; }
         if (file.size > maxBytes) { this.value = ""; alert("La imagen supera 2MB."); return; }
         const url = URL.createObjectURL(file);
         $cThumb.html(`<img src="${url}" alt="preview" style="max-height:120px;border-radius:8px;">`);
         $cThumb.find("img").on("load", () => URL.revokeObjectURL(url));
      });
   }

   /* ===== Inicializar módulos ===== */
   CategoriesModule.init();

   const phonesInstance = TagsModule.create($("#phonesTags"), {
      name: $("#phonesTags").data("name"),
      type: $("#phonesTags").data("type"),
      max: $("#phonesTags").data("max")
   });

   const emailsInstance = TagsModule.create($("#emailsTags"), {
      name: $("#emailsTags").data("name"),
      type: $("#emailsTags").data("type"),
      max: $("#emailsTags").data("max")
   });

   MapModule.init("map", "#latInput", "#lngInput");

   /* ===== Helper esperar ===== */
   function waitUntil(checkFn, cb, { tries = 20, delay = 100 } = {}) {
      let left = tries;
      (function tick() {
         if (checkFn()) return cb();
         if (--left <= 0) return;
         setTimeout(tick, delay);
      })();
   }

   /* ===== Precarga en modo edición ===== */
   if (window.__COMMERCE_DATA__) {
      const { categories = [], phones = [], emails = [] } = window.__COMMERCE_DATA__;

      // 1) Categorías
      waitUntil(
         () => typeof CategoriesModule.setSelected === "function",
         () => CategoriesModule.setSelected(categories.map(String)),
         { tries: 30, delay: 100 }
      );

      // 2) Teléfonos / emails
      waitUntil(
         () => typeof TagsModule.setValues === "function",
         () => {
            TagsModule.setValues($("#phonesTags"), phones);
            TagsModule.setValues($("#emailsTags"), emails);
         },
         { tries: 30, delay: 100 }
      );

      // 3) Mapa (refuerzo)
      waitUntil(
         () => typeof MapModule.setLatLng === "function",
         () => {
            const lat = parseFloat($("#latInput").val());
            const lng = parseFloat($("#lngInput").val());
            if (!isNaN(lat) && !isNaN(lng)) {
               MapModule.setLatLng({ lat, lng });
            }
         },
         { tries: 20, delay: 100 }
      );
   }

   function writeCategoriesHiddenInputs(ids) {
      const cont = $("#categoriesHidden");
      cont.empty();
      ids.forEach(id => {
         cont.append(`<input type="hidden" name="categories[]" value="${id}">`);
      });
   }

   /* ===== Validación ===== */
   const form = document.getElementById("comercioForm");
   form.addEventListener("submit", function (e) {

      const htmlValid = form.checkValidity();

      const catIds = CategoriesModule.getSelectedIds ? CategoriesModule.getSelectedIds() : [];
      writeCategoriesHiddenInputs(catIds);

      const phones = TagsModule.getValues($("#phonesTags")) || [];
      const emails = TagsModule.getValues($("#emailsTags")) || [];

      let customInvalid = false;

      // Categorías
      if (catIds.length < 1) {
         $("#categoriesSection").addClass("is-invalid");
         $("#categoriesFeedback").show();
         customInvalid = true;
      } else {
         $("#categoriesSection").removeClass("is-invalid");
         $("#categoriesFeedback").hide();
      }

      // Telefónos
      if (phones.length < 1) {
         $("#phonesSection").addClass("is-invalid");
         $("#phonesFeedback").show();
         customInvalid = true;
      } else {
         $("#phonesSection").removeClass("is-invalid");
         $("#phonesFeedback").hide();
      }

      // Emails
      if (emails.length < 1) {
         $("#emailsSection").addClass("is-invalid");
         $("#emailsFeedback").show();
         customInvalid = true;
      } else {
         $("#emailsSection").removeClass("is-invalid");
         $("#emailsFeedback").hide();
      }

      if (!htmlValid || customInvalid) {
         e.preventDefault(); e.stopPropagation();
      }

      form.classList.add("was-validated");
   }, false);

});
