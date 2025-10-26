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

   /* ===== Inicializar módulos existentes ===== */
   CategoriesModule.init();
   TagsModule.create($("#phonesTags"), {
      name: $("#phonesTags").data("name"),
      type: $("#phonesTags").data("type"),
      max: $("#phonesTags").data("max")
   });
   TagsModule.create($("#emailsTags"), {
      name: $("#emailsTags").data("name"),
      type: $("#emailsTags").data("type"),
      max: $("#emailsTags").data("max")
   });
   MapModule.init("map", "#latInput", "#lngInput");

   /* ===== Pre-cargar datos en edición (si existen) ===== */
   if (window.__COMMERCE_DATA__) {
      const { categories = [], phones = [], emails = [] } = window.__COMMERCE_DATA__;
      if (CategoriesModule.setSelected) CategoriesModule.setSelected(categories);
      if (TagsModule.setValues) {
         TagsModule.setValues($("#phonesTags"), phones);
         TagsModule.setValues($("#emailsTags"), emails);
      }
   }

   /* ===== Guardar hidden inputs de categorías antes de enviar ===== */
   function writeCategoriesHiddenInputs(ids) {
      const cont = $("#categoriesHidden");
      cont.empty();
      ids.forEach(id => {
         cont.append(`<input type="hidden" name="categories[]" value="${id}">`);
      });
   }

   /* ===== Validación Bootstrap + mínimos requeridos ===== */
   const form = document.getElementById("comercioForm");
   form.addEventListener("submit", function (e) {
      // 1) Valida HTML5 estándar
      if (!form.checkValidity()) {
         e.preventDefault(); e.stopPropagation();
      }

      // 2) Valida “mínimos” de los widgets custom
      const catIds = (CategoriesModule.getSelectedIds && CategoriesModule.getSelectedIds()) || [];
      writeCategoriesHiddenInputs(catIds);

      const phones = (TagsModule.getValues && TagsModule.getValues($("#phonesTags"))) || [];
      const emails = (TagsModule.getValues && TagsModule.getValues($("#emailsTags"))) || [];

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

      // Teléfonos
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

      // Si algo falla, no enviamos
      if (!form.checkValidity() || customInvalid) {
         e.preventDefault(); e.stopPropagation();
      }

      form.classList.add("was-validated");
   }, false);
});