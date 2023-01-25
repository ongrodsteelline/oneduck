<?php

namespace App\Modules\Wordpress\Models;

use WP_User;

class User
{
    protected $user;

    public function __construct()
    {
        $this->user = wp_get_current_user();
    }

    /**
     * @return WP_User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Возвращаем группу пользователя
     * Для неавторизованных возвращаем группу Б
     * У кого отсутствует группа назначаем и возвращаем группу Б
     * Возможные варианты: cash, cashless, mixed
     * @return string
     */
    public function getGroup(): string
    {
        if ($this->getUser() === 0) {
            return 'cashless';
        }

        $group = get_field('profile_group', 'user_'.$this->getUser()->ID);

        if ($group === null) {
            $this->setGroup($this->getUser()->ID, 'cashless');
            return 'cashless';
        }

        return $group;
    }

    /**
     * Сохраняем промежуточное состояние группы mixed
     */
    public function setGroupMixed(string $value)
    {
        update_user_meta($this->getUser()->ID, 'cf_group_mixed', $value);
    }

    public function getGroupMixed()
    {
        $value = get_user_meta($this->getUser()->ID, 'cf_group_mixed', true);
        return $value ? $value : 'cashless';
    }

    protected function setGroup(int $userId, string $group)
    {
        update_field('profile_group', $group, 'user_' . $userId);
    }

    public function hasHiddenColumn($column)
    {
        $columns = get_user_meta($this->getUser()->ID, 'hidden_catalog_columns', true);

        return in_array($column, $columns);
    }
}
