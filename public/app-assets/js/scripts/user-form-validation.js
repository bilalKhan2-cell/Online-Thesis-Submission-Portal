$("#frmUsers").validate({
    rules:{
        name:{
            required:true,
        },
        email:{
            required:true,
            email:true
        },
        address:{
            required:true
        }
    },
    messages:{
        name:{
            required:"Username is Required.."
        },
        email:{
            required:"Email Address is Required..",
            email:"Invalid Email Address Format"
        },
        address:{
            required:"User Address is Required.."
        }
    }
})