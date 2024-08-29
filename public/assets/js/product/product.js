
    // const initDataTable = () => {
    //     dataTable = $("#ajax-datatables").DataTable({
    //         ordering: true,
    //         retrieve: true,
    //         dom: "Bfrtip",
    //         pageLength: 25,
    //         destroy: true,
    //         bDestroy: true,
    //         processing: true,
    //         serverSide: false,
    //         ajax: {
    //             url: `api/product`,
    //             dataFilter: function (data) {
    //                 var json = jQuery.parseJSON(data);
    //                 json.recordsTotal = json.message.totalRecord;
    //                 json.recordsFiltered = json.message.totalRecord;
    //                 json.data = json.data;
    //                 return JSON.stringify(json); // return JSON string
    //             },
    //         },
    //         columns: [
    //             {
    //                 data: "id",
    //             },
    //             {
    //                 data: "type",
    //                 width: 200,
    //             },
    //             {
    //                 data: function (data) {
    //                     return ` <button  onclick="btnEdit(${data.id})" class="btn btn-info btn-edit">Edit</button>
    //                                     <button  onclick="btnDelete(${data.id})" class="btn btn-danger btn-delete">Delete</button>`;
    //                 },
    //             },
    //         ],
    //     });
    // };
    // initDataTable();
    $(document).ready(function () {
        var e = $("#add-rows").DataTable(),
            a = 1;
        $("#addRow").on("click", function () {
            e.row
                .add([
                    a + ".1",
                    a + ".2",
                    a + ".3",
                    a + ".4",
                    a + ".5",
                    a + ".6",
                    a + ".7",
                    a + ".8",
                    a + ".9",
                    a + ".10",
                    a + ".11",
                    a + ".12",
                ])
                .draw(!1),
                a++;
        }),
            $("#addRow").click();
    }),
        $(document).ready(function () {
            $("#ajax-datatables").DataTable();
        }),
        document.addEventListener("DOMContentLoaded", function () {
            new DataTable("#ajax-datatables", {
                ajax: "/api/product",
            });
        });


    //     KTApp.block('#ajax-datatables .kt-portlet__body', {});
    //     $.ajax({
    //         type: 'GET',
    //         url: "/product",
    //         dataType: "json",
    //         data: {
                
    //         },
    //         success: function(response, status) {
    //             KTApp.unblockPage();
    //             if (response.status == true) {
    //                 var template = '';
    //                 var no = 1;
    //                 var amount = 0;
    //                 var admin = 0;
    //                 var totalDPD = 0;
    //                 var totalDenda = 0;
    //                 var totalPelunasan = 0;
    //                 var totalTafsiran = 0;
    //                 var status = "";
    //                 var sewa = 0;
    //                 var dpd = 0;

    //                 $.each(response.data, function(index, data) {
                       
                   
    //                 });
    //                 // template += "<tr class='rowappend'>";
    //                 // template += "<td colspan='13' class='text-right'>Total</td>";
    //                 // template += "<td class='text-right'>" + convertToRupiah(admin) + "</td>";
    //                 // template += "<td class='text-right'>" + convertToRupiah(amount) + "</td>";
    //                 // template += "<td class='text-right'>" + totalDPD + "</td>";
    //                 // template += "<td class='text-right'>" + convertToRupiah(totalTafsiran) +
    //                 // "</td>";
    //                 // template += "<td class='text-right'>" + convertToRupiah(totalDenda) + "</td>";
    //                 // template += "<td class='text-right'>" + convertToRupiah(totalPelunasan) +
    //                 //     "</td>";
    //                 // template += "<td class='text-right'></td>";
    //                 // template += '</tr>';
    //                 // $('.kt-section__content table').append(template);
    //             }
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             KTApp.unblockPage();
    //         },
    //         complete: function() {
    //             KTApp.unblock('#ajax-datatables .kt-portlet__body', {});
    //         }
    //     });