/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)} 
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Rank} from "../forum/ranks/Rank";
import {Forum} from "../forum/Forum";

export class Utils {

   public parseTime(dat: Date): string {
       const now: Date = new Date();
       const date: Date = new Date(dat);
       const today: boolean = date.getDay() == now.getDay() && date.getMonth() == now.getMonth() && date.getFullYear() == now.getFullYear();
       let result = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' at ' + date.getHours() + ':' + date.getMinutes();
       if (today) result = 'Today at ' + date.getHours() + ':' + date.getMinutes();
       return result;
   }

   public getRank(rank: number): Rank {
       return Forum.instance.getRank(rank);
   }

   public getRankName(rank: number): string {
       const r: Rank = Forum.instance.getRank(rank);
       if (r === null) return Forum.instance.getRank(1).name;
       return r.name;
   }

   public static installed(): boolean {
       return !Forum.instance.config.installed;
   }
}