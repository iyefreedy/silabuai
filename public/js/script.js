$(function () {
  $("#roomModal").on("show.bs.modal", function (event) {
    var modal = $(this);
    var button = $(event.relatedTarget);
    var modalType = button.data("modal-type");

    if (modalType === "insert") {
      modal.find(".modal-title").text("Tambah Ruangan");
      modal.find(".form-control").attr("disabled", false);
      modal.find("[type=submit]").show();
      modal.find("[name=id]").val("");
      modal.find("[name=room_name]").val("");
      modal.find("[name=room_description]").val("");
      modal.find("[method=post]").attr("action", button.data("action"));
    }

    if (modalType === "show") {
      modal.find(".modal-title").text("Detail Ruangan");
      modal.find(".form-control").attr("disabled", true);
      modal.find("[type=submit]").hide();
      modal.find("[name=id]").val(button.data("id"));
      modal.find("[name=room_name]").val(button.data("room-name"));
      modal
        .find("[name=room_description]")
        .val(button.data("room-description"));
      modal.find("[method=post]").attr("action", button.data("action"));
    }

    if (modalType === "edit") {
      modal.find(".modal-title").text("Edit Ruangan");
      modal.find(".form-control").attr("disabled", false);
      modal.find("[type=submit]").show();
      modal.find("[name=id]").val(button.data("id"));
      modal.find("[name=room_name]").val(button.data("room-name"));
      modal
        .find("[name=room_description]")
        .val(button.data("room-description"));
      modal.find("[method=post]").attr("action", button.data("action"));
    }
  });

  $("#deleteRoomModal").on("show.bs.modal", function (event) {
    var modal = $(this);
    var button = $(event.relatedTarget);

    modal
      .find(".modal-body")
      .text(
        "Apakah anda yakin ingin menghapus ruangan " +
          button.data("room-name") +
          "?"
      );
    modal.find("[name=id]").val(button.data("id"));
  });

  $("#toolModal").on("show.bs.modal", function (event) {
    var modal = $(this);
    var button = $(event.relatedTarget);
    var modalType = button.data("modal-type");

    if (modalType === "insert") {
      modal.find(".modal-title").text("Tambah Ruangan");
      modal.find(".form-control").attr("disabled", false);
      modal.find("[type=submit]").show();
      modal.find("[name=id]").val("");
      modal.find("[name=room_id]").val("");
      modal.find("[name=tool_name]").val("");
      modal.find("[name=tool_description]").val("");
      modal.find("[name=tool_quantity]").val("");
      modal.find("[method=post]").attr("action", button.data("action"));
    }

    if (modalType === "show") {
      modal.find(".modal-title").text("Detail Ruangan");
      modal.find(".form-control").attr("disabled", true);
      modal.find("[type=submit]").hide();
      modal.find("[name=id]").val(button.data("id"));
      modal.find("[name=room_id]").val(button.data("room-id"));
      modal.find("[name=tool_name]").val(button.data("tool-name"));
      modal
        .find("[name=tool_description]")
        .val(button.data("tool-description"));
      modal.find("[name=tool_quantity]").val(button.data("tool-quantity"));
      modal.find("[method=post]").attr("action", button.data("action"));
    }

    if (modalType === "edit") {
      modal.find(".modal-title").text("Edit Ruangan");
      modal.find(".form-control").attr("disabled", false);
      modal.find("[type=submit]").show();
      modal.find("[name=id]").val(button.data("id"));
      modal.find("[name=room_id]").val(button.data("room-id"));
      modal.find("[name=tool_name]").val(button.data("tool-name"));
      modal
        .find("[name=tool_description]")
        .val(button.data("tool-description"));
      modal.find("[name=tool_quantity]").val(button.data("tool-quantity"));
      modal.find("[method=post]").attr("action", button.data("action"));
    }
  });

  $("#deleteToolModal").on("show.bs.modal", function (event) {
    var modal = $(this);
    var button = $(event.relatedTarget);

    modal
      .find(".modal-body")
      .text(
        "Apakah anda yakin ingin menghapus alat " +
          button.data("tool-name") +
          "?"
      );
    modal.find("[name=id]").val(button.data("id"));
  });

  $("#select-role").on("change", function () {
    var role = $(this).val();

    if (role === "mahasiswa") {
      $("#id-number-input").removeClass("d-none");
    } else {
      $("#id-number-input").addClass("d-none");
    }
  });

  $("#start-time").datetimepicker({
    minDate: new Date(),
    minTime: "07:00",
    maxTime: "22:00",
    lang: "id",
    step: 50,
    onSelectTime: function (currentTime, input) {
      let futureDate = new Date(currentTime.getTime() + 50 * 60000);
      let futureYear = futureDate.getFullYear();
      let futureMonth = ("0" + (futureDate.getMonth() + 1)).slice(-2);
      let futureDay = ("0" + futureDate.getDate()).slice(-2);
      let futureHour = ("0" + futureDate.getHours()).slice(-2);
      let futureMinute = ("0" + futureDate.getMinutes()).slice(-2);

      $("#end-time").val(
        `${futureYear}/${futureMonth}/${futureDay} ${futureHour}:${futureMinute}`
      );
    },
  });
});

$(".form-check-input").on("change", function (event) {
  let id = $(this).attr("value");
  if ($(this).is(":checked")) {
    $(`#defaultInput${id}`).prop("disabled", false);
  } else {
    $(`#defaultInput${id}`).prop("disabled", true);
    $(`#defaultInput${id}`).prop("value", 0);
  }
});
