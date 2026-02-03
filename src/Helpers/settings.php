<?php
// src/Helpers/settings.php

function get_settings($pdo) {
    try {
        $stmt = $pdo->query("SELECT setting_key, setting_value FROM system_settings");
        $settings = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    } catch (PDOException $e) {
        return [];
    }
}

function get_setting($pdo, $key, $default = '') {
    try {
        $stmt = $pdo->prepare("SELECT setting_value FROM system_settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['setting_value'] : $default;
    } catch (PDOException $e) {
        return $default;
    }
}

function update_setting($pdo, $key, $value) {
    try {
        $stmt = $pdo->prepare("INSERT INTO system_settings (setting_key, setting_value) VALUES (?, ?) 
                              ON CONFLICT (setting_key) DO UPDATE SET setting_value = EXCLUDED.setting_value, updated_at = CURRENT_TIMESTAMP");
        return $stmt->execute([$key, $value]);
    } catch (PDOException $e) {
        return false;
    }
}
