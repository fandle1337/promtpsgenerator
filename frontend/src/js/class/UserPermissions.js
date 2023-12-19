import store from "../store";
import router from "../router";

export function checkUserPermissionByName(routeName) {
    const routePermission = router.resolve({name: routeName}).meta.permissions
    const userPermission = store.state.settings.appSettings.user_permission_group

    return checkUserPermission(routePermission, userPermission)
}

export function checkUserPermission(routePermissions, userPermission) {
    return routePermissions.includes(userPermission) || routePermissions.length === 0
}

export function hasRightsToEdit() {
    if (store.state.settings.appSettings.user_permission_group === 'A') {
        return true
    }
    let hrUserList = (store.state.settings.hrUserList === "") ? [] : store.state.settings.hrUserList
    return !!hrUserList.find(x => x.id === parseInt(store.state.settings.appSettings.user_id))


}