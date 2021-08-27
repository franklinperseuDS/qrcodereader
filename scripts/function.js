
function formatDate(_dateOld){
    const _dt= new Date(_dateOld)
    const br_dt = _dt.toLocaleDateString()
    // document.write(br_dt)
    return br_dt
}
