require('bootstrap-table')
require('bootstrap-table/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min')
const Swal = require('sweetalert2')

const editDeviceUrl = document.querySelector('meta[name="edit-device-url"]').getAttribute('content')
const deleteDeviceUrl = document.querySelector('meta[name="delete-device-url"]').getAttribute('content')

window.actionFormatter = function(value, row) {
    const url = editDeviceUrl.replace(':id', value)
    const actions = []
    actions.push( `<a href='${url}' class='btn btn-primary'><i class="far fa-eye"></i></a>`)
    actions.push('&nbsp;')
    actions.push( `<a href='#' onclick="del(${value})" class='btn btn-danger'><i class="fas fa-trash"></i></a>`)
    return actions.join('')
}

window.numberFormatter = function (value, row, index) {
    return index+1
}

window.modelFormatter = function (value, row, index) {
    if (value ==='swm')
    {
        return 'Sindcon Water Meter'
    } else if (value === 'swp')
    {
        return 'Sindcon Water Pressure'
    } else if (value === 'ci')
    {
        return 'Cybel Incometer'
    } else if (value === 'lt')
    {
        return 'Lansitec Tracker'
    }
    return ''
}

window.del = function (id)
{
    Swal.fire({
        title: 'Do you really want to delete this device?',
        showCancelButton: true,
        confirmButtonText: `Yes`
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            axios.post(deleteDeviceUrl.replace(':id', id))
                .then(function (response) {
                    const data = response.data
                    if (data.success)
                    {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: `Device deleted.`,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            window.location.reload()
                        })
                    }
                })
                .catch(function (error) {
                    console.log(error)
                })

        }
    })
}
