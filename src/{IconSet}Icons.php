<?php

namespace {vendor_namespace}\Icons\{IconSet};

use {vendor_namespace}\Icons\{IconSet}\Enums\{IconSet};
use {vendor_namespace}\Icons\{IconSet}\Enums\{IconSet}Style; // Optional, if styles exist
use Filafly\Icons\IconSet;
use Filament\Actions\View\ActionsIconAlias;
use Filament\Forms\View\FormsIconAlias;
use Filament\Infolists\View\InfolistsIconAlias;
use Filament\Notifications\View\NotificationsIconAlias;
use Filament\Schemas\View\SchemaIconAlias;
use Filament\Support\View\SupportIconAlias;
use Filament\Tables\View\TablesIconAlias;
use Filament\View\PanelsIconAlias;

class {IconSet}Icons extends IconSet
{
    protected string $pluginId = '{vendor}-filament-{iconset}-icons';

    protected mixed $iconEnum = {IconSet}::class;

    protected string $iconPrefix = '{iconset}'; // e.g., 'phosphor', 'carbon'

    // Optional: Only if icon set has multiple styles
    protected mixed $styleEnum = {IconSet}Style::class;

    protected array $iconMap = [
        // Panels icon aliases
        PanelsIconAlias::GLOBAL_SEARCH_FIELD => {IconSet}::Replace,
        PanelsIconAlias::PAGES_DASHBOARD_ACTIONS_FILTER => {IconSet}::Replace,
        PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM => {IconSet}::Replace,
        PanelsIconAlias::PAGES_PASSWORD_RESET_REQUEST_PASSWORD_RESET_ACTIONS_LOGIN => {IconSet}::Replace,
        PanelsIconAlias::PAGES_PASSWORD_RESET_REQUEST_PASSWORD_RESET_ACTIONS_LOGIN_RTL => {IconSet}::Replace,
        PanelsIconAlias::RESOURCES_PAGES_EDIT_RECORD_NAVIGATION_ITEM => {IconSet}::Replace,
        PanelsIconAlias::RESOURCES_PAGES_MANAGE_RELATED_RECORDS_NAVIGATION_ITEM => {IconSet}::Replace,
        PanelsIconAlias::RESOURCES_PAGES_VIEW_RECORD_NAVIGATION_ITEM => {IconSet}::Replace,
        PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON_RTL => {IconSet}::Replace,
        PanelsIconAlias::SIDEBAR_EXPAND_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::SIDEBAR_EXPAND_BUTTON_RTL => {IconSet}::Replace,
        PanelsIconAlias::SIDEBAR_GROUP_COLLAPSE_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::TENANT_MENU_BILLING_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::TENANT_MENU_PROFILE_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::TENANT_MENU_REGISTRATION_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::TENANT_MENU_TOGGLE_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::THEME_SWITCHER_LIGHT_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::THEME_SWITCHER_DARK_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::THEME_SWITCHER_SYSTEM_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::TOPBAR_CLOSE_SIDEBAR_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::TOPBAR_OPEN_SIDEBAR_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::TOPBAR_GROUP_TOGGLE_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::TOPBAR_OPEN_DATABASE_NOTIFICATIONS_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::USER_MENU_PROFILE_ITEM => {IconSet}::Replace,
        PanelsIconAlias::USER_MENU_LOGOUT_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::WIDGETS_ACCOUNT_LOGOUT_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::WIDGETS_FILAMENT_INFO_OPEN_DOCUMENTATION_BUTTON => {IconSet}::Replace,
        PanelsIconAlias::WIDGETS_FILAMENT_INFO_OPEN_GITHUB_BUTTON => {IconSet}::Replace,

        // Forms icon aliases
        FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_CLONE => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_COLLAPSE => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_DELETE => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_EXPAND => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_MOVE_DOWN => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_MOVE_UP => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_REORDER => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_CHECKBOX_LIST_SEARCH_FIELD => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_DRAG_CROP => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_DRAG_MOVE => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_FLIP_HORIZONTAL => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_FLIP_VERTICAL => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_MOVE_DOWN => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_MOVE_LEFT => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_MOVE_RIGHT => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_MOVE_UP => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ROTATE_LEFT => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ROTATE_RIGHT => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ZOOM_100 => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ZOOM_IN => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ZOOM_OUT => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_KEY_VALUE_ACTIONS_DELETE => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_KEY_VALUE_ACTIONS_REORDER => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_CLONE => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_COLLAPSE => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_DELETE => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_EXPAND => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_MOVE_DOWN => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_MOVE_UP => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_REORDER => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_SELECT_ACTIONS_CREATE_OPTION => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_SELECT_ACTIONS_EDIT_OPTION => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_TEXT_INPUT_ACTIONS_HIDE_PASSWORD => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_TEXT_INPUT_ACTIONS_SHOW_PASSWORD => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_TOGGLE_BUTTONS_BOOLEAN_FALSE => {IconSet}::Replace,
        FormsIconAlias::COMPONENTS_TOGGLE_BUTTONS_BOOLEAN_TRUE => {IconSet}::Replace,

        // Tables icon aliases
        TablesIconAlias::ACTIONS_COLUMN_MANAGER => {IconSet}::Replace,
        TablesIconAlias::ACTIONS_DISABLE_REORDERING => {IconSet}::Replace,
        TablesIconAlias::ACTIONS_ENABLE_REORDERING => {IconSet}::Replace,
        TablesIconAlias::ACTIONS_FILTER => {IconSet}::Replace,
        TablesIconAlias::ACTIONS_GROUP => {IconSet}::Replace,
        TablesIconAlias::ACTIONS_OPEN_BULK_ACTIONS => {IconSet}::Replace,
        TablesIconAlias::COLUMNS_COLLAPSE_BUTTON => {IconSet}::Replace,
        TablesIconAlias::COLUMNS_ICON_COLUMN_FALSE => {IconSet}::Replace,
        TablesIconAlias::COLUMNS_ICON_COLUMN_TRUE => {IconSet}::Replace,
        TablesIconAlias::EMPTY_STATE => {IconSet}::Replace,
        TablesIconAlias::FILTERS_QUERY_BUILDER_CONSTRAINTS_BOOLEAN => {IconSet}::Replace,
        TablesIconAlias::FILTERS_QUERY_BUILDER_CONSTRAINTS_DATE => {IconSet}::Replace,
        TablesIconAlias::FILTERS_QUERY_BUILDER_CONSTRAINTS_NUMBER => {IconSet}::Replace,
        TablesIconAlias::FILTERS_QUERY_BUILDER_CONSTRAINTS_RELATIONSHIP => {IconSet}::Replace,
        TablesIconAlias::FILTERS_QUERY_BUILDER_CONSTRAINTS_SELECT => {IconSet}::Replace,
        TablesIconAlias::FILTERS_QUERY_BUILDER_CONSTRAINTS_TEXT => {IconSet}::Replace,
        TablesIconAlias::FILTERS_REMOVE_ALL_BUTTON => {IconSet}::Replace,
        TablesIconAlias::GROUPING_COLLAPSE_BUTTON => {IconSet}::Replace,
        TablesIconAlias::HEADER_CELL_SORT_ASC_BUTTON => {IconSet}::Replace,
        TablesIconAlias::HEADER_CELL_SORT_BUTTON => {IconSet}::Replace,
        TablesIconAlias::HEADER_CELL_SORT_DESC_BUTTON => {IconSet}::Replace,
        TablesIconAlias::REORDER_HANDLE => {IconSet}::Replace,
        TablesIconAlias::SEARCH_FIELD => {IconSet}::Replace,

        // Notifications icon aliases
        NotificationsIconAlias::DATABASE_MODAL_EMPTY_STATE => {IconSet}::Replace,
        NotificationsIconAlias::NOTIFICATION_CLOSE_BUTTON => {IconSet}::Replace,
        NotificationsIconAlias::NOTIFICATION_DANGER => {IconSet}::Replace,
        NotificationsIconAlias::NOTIFICATION_INFO => {IconSet}::Replace,
        NotificationsIconAlias::NOTIFICATION_SUCCESS => {IconSet}::Replace,
        NotificationsIconAlias::NOTIFICATION_WARNING => {IconSet}::Replace,

        // Actions icon aliases
        ActionsIconAlias::ACTION_GROUP => {IconSet}::Replace,
        ActionsIconAlias::CREATE_ACTION_GROUPED => {IconSet}::Replace,
        ActionsIconAlias::DELETE_ACTION => {IconSet}::Replace,
        ActionsIconAlias::DELETE_ACTION_GROUPED => {IconSet}::Replace,
        ActionsIconAlias::DELETE_ACTION_MODAL => {IconSet}::Replace,
        ActionsIconAlias::DETACH_ACTION => {IconSet}::Replace,
        ActionsIconAlias::DETACH_ACTION_MODAL => {IconSet}::Replace,
        ActionsIconAlias::DISSOCIATE_ACTION => {IconSet}::Replace,
        ActionsIconAlias::DISSOCIATE_ACTION_MODAL => {IconSet}::Replace,
        ActionsIconAlias::EDIT_ACTION => {IconSet}::Replace,
        ActionsIconAlias::EDIT_ACTION_GROUPED => {IconSet}::Replace,
        ActionsIconAlias::EXPORT_ACTION_GROUPED => {IconSet}::Replace,
        ActionsIconAlias::FORCE_DELETE_ACTION => {IconSet}::Replace,
        ActionsIconAlias::FORCE_DELETE_ACTION_GROUPED => {IconSet}::Replace,
        ActionsIconAlias::FORCE_DELETE_ACTION_MODAL => {IconSet}::Replace,
        ActionsIconAlias::IMPORT_ACTION_GROUPED => {IconSet}::Replace,
        ActionsIconAlias::MODAL_CONFIRMATION => {IconSet}::Replace,
        ActionsIconAlias::REPLICATE_ACTION => {IconSet}::Replace,
        ActionsIconAlias::REPLICATE_ACTION_GROUPED => {IconSet}::Replace,
        ActionsIconAlias::RESTORE_ACTION => {IconSet}::Replace,
        ActionsIconAlias::RESTORE_ACTION_GROUPED => {IconSet}::Replace,
        ActionsIconAlias::RESTORE_ACTION_MODAL => {IconSet}::Replace,
        ActionsIconAlias::VIEW_ACTION => {IconSet}::Replace,
        ActionsIconAlias::VIEW_ACTION_GROUPED => {IconSet}::Replace,

        // Infolists icon aliases
        InfolistsIconAlias::COMPONENTS_ICON_ENTRY_FALSE => {IconSet}::Replace,
        InfolistsIconAlias::COMPONENTS_ICON_ENTRY_TRUE => {IconSet}::Replace,

        // Schema icon aliases
        SchemaIconAlias::COMPONENTS_WIZARD_COMPLETED_STEP => {IconSet}::Replace,

        // Support icon aliases
        SupportIconAlias::BADGE_DELETE_BUTTON => {IconSet}::Replace,
        SupportIconAlias::BREADCRUMBS_SEPARATOR => {IconSet}::Replace,
        SupportIconAlias::BREADCRUMBS_SEPARATOR_RTL => {IconSet}::Replace,
        SupportIconAlias::MODAL_CLOSE_BUTTON => {IconSet}::Replace,
        SupportIconAlias::PAGINATION_FIRST_BUTTON => {IconSet}::Replace,
        SupportIconAlias::PAGINATION_FIRST_BUTTON_RTL => {IconSet}::Replace,
        SupportIconAlias::PAGINATION_LAST_BUTTON => {IconSet}::Replace,
        SupportIconAlias::PAGINATION_LAST_BUTTON_RTL => {IconSet}::Replace,
        SupportIconAlias::PAGINATION_NEXT_BUTTON => {IconSet}::Replace,
        SupportIconAlias::PAGINATION_NEXT_BUTTON_RTL => {IconSet}::Replace,
        SupportIconAlias::PAGINATION_PREVIOUS_BUTTON => {IconSet}::Replace,
        SupportIconAlias::PAGINATION_PREVIOUS_BUTTON_RTL => {IconSet}::Replace,
        SupportIconAlias::SECTION_COLLAPSE_BUTTON => {IconSet}::Replace,
    ];
}