<?php
namespace App\Traits;

trait CommentTrait{
    public function getJsonComments($comments_array)
    {
        $outputTree = [];
        if (count($comments_array) > 0) {
            $outputTree = $this->transformTreeComments($comments_array);
        }
        return $outputTree;
    }

    public function transformTreeComments($treeArray, $parentId = null)
    {
        $output = [];
        foreach ($treeArray as $node) {
            if ($node['parent_id'] == $parentId) {
                $children = $this->transformTreeComments($treeArray, $node['id']);
                $node['children'] = $children ? $children : [];
                $node["created"] = $this->time_ago_in_php(strtotime($node["created_at"]));
                $node['pid'] = $node["parent_id"];

                unset($node["parent_id"]);
                unset($node["type"]);
                unset($node["ip"]);
                unset($node["created_at"]);
                unset($node["updated_at"]);

                $output[] = $node;

                unset($node);
            }
        }
        return $output;
    }

    public function time_ago_in_php($unix)
    {

        $time_ago        = $unix;
        $current_time    = time();
        $time_difference = $current_time - $time_ago;
        $seconds         = $time_difference;

        $minutes = round($seconds / 60); // value 60 is seconds
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
        $weeks   = round($seconds / 604800); // 7*24*60*60;
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

        if ($seconds <= 60) {

            return "Moments ago";
        } else if ($minutes <= 60) {

            if ($minutes == 1) {

                return "1 minute ago";
            } else {

                return "$minutes minutes ago";
            }
        } else if ($hours <= 24) {

            if ($hours == 1) {

                return "1 hour ago";
            } else {

                return "$hours hours ago";
            }
        } else if ($days <= 7) {

            if ($days == 1) {

                return "yesterday";
            } else {

                return "$days day ago";
            }
        } else if ($weeks <= 4.3) {

            if ($weeks == 1) {

                return "week ago";
            } else {

                return "$weeks week ago";
            }
        } else if ($months <= 12) {

            if ($months == 1) {

                return "1 month ago";
            } else {

                return "$months months ago";
            }
        } else {

            if ($years == 1) {

                return "1 year ago";
            } else {

                return "$years years ago";
            }
        }
    }
}