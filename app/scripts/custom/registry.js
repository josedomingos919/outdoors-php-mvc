$(document).ready(() => {
  /* function */
  const getMunicipality = () => {
    const provinceId = $("#province_input").val();

    $.get(
      `http://localhost/outdoors/municipality/all&province_id=${provinceId}`,
      (response) => {
        try {
          const data = JSON.parse(response);

          $("#municipality_input").html("<option></option>");
          $("#municipality_input").append(
            data.map(({ id, name }) => `<option value="${id}">${name}</option>`)
          );
        } catch (error) {
          bootbox.alert({
            title: "Atenção!",
            message: "Falha ao carregar municipios!",
          });
        }
      }
    );
  };

  const getCommune = () => {
    const municipalityId = $("#municipality_input").val();

    $.get(
      `http://localhost/outdoors/commune/all&municipality_id=${municipalityId}`,
      (response) => {
        try {
          const data = JSON.parse(response);

          $("#commune_input").html("<option></option>");
          $("#commune_input").append(
            data.map(({ id, name }) => `<option value="${id}">${name}</option>`)
          );
        } catch (error) {
          bootbox.alert({
            title: "Atenção!",
            message: "Falha ao carregar municipios!",
          });
        }
      }
    );
  };

  const hideCompanyActivity = () => {
    if ($("#customer_type_input").val() == "2") {
      $("#activity_container").hide();
    } else {
      $("#activity_container").show();
    }
  };

  /* events */
  $("#customer_type_input").change(() => {
    $("#activity_input").val("");
    hideCompanyActivity();
  });

  $("#municipality_input").change(() => {
    getCommune();
  });

  $("#province_input").change(() => {
    $("#commune_input").html("");
    $("#municipality_input").html("");

    getMunicipality();
  });

  /* calls */
  hideCompanyActivity();
});
