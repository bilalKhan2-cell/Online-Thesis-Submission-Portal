$.validator.addMethod("maskedRequired", function(value, element) {
    return $("#txtSupervisorCNIC").val();
}, "Superivsor CNIC is Required..");

$.validator.addMethod("maskedRequired", function(value, element) {
    return $("#txtSupervisorContactInfo").val();
}, "Superivsor Contact No. is Required..");

$("#txtSupervisorContactInfo").formatter({
    pattern: "{{9999}}-{{9999999}}",
    persistent: true
});

$("#txtSupervisorCNIC").formatter({
    pattern: "{{99999}}-{{9999999}}-{{9}}",
    persistent: true
});

$("#frmSupervisor").validate({
    rules: {
        name: {
            required: true
        },
        fname: {
            required: true
        },
        contact_info: {
            required: true,
            // maskedRequired:true
        },
        cnic: {
            required: true,
            // maskedRequired:true
        },
        email: {
            required: true
        },
        address: {
            required: true
        }
    },
    messages: {
        name: {
            required: "Supervisor Name is Required.."
        },
        email: {
            required: "Email Address is Required."
        },
        fname: {
            required: "Father Name is Required.."
        },
        contact_info: {
            required: "Contact No. is Required..",
        },
        cnic: {
            required: "Supervisor CNIC is Required.."
        },
        address: {
            required: "Address is Required.."
        }
    }
})
