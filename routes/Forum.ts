/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Router} from "express";
import {Database} from "../db/Database";
import {Website} from "../Website";
import {Lang} from "../lang/Lang";
import {ForumData} from "../forum/data/ForumData";
import {PostData} from "../forum/data/PostData";

const router = Router();

router.get('/:id', (req, res, next) => {
    Database.hasConnection(connection => {
        if (connection) {
            res.render('errors/503');
            return;
        }
    });

    Database.query("SELECT * FROM `forum` WHERE `id`='" + req.params.id + "'", (error, forums) => {
        Database.query("SELECT * FROM `posts`", (error, posts) => {
            const lang = req.session.name == null ? Website.config.lang : req.session.lang;
            const data = {
                siteName: Website.config.siteName,
                lang: new Lang(lang)
            }
            const forum: { status: number, forum: ForumData } = loadData(forums[0], posts);
            if (forum.status === 0) return;
            res.render('forum', { title: 'Forum', content: forum.forum, data: data });
        });
    })
});

const parse = (data: string): any => {
    if (data === null || data === undefined) return [ { id: -18348 } ];
    return JSON.parse(JSON.stringify(data));
}

const loadData = (f, posts): { status: number, forum: ForumData } => {
    const forum: ForumData = new ForumData(f.id);
    forum.title = f.title;
    forum.description = f.desc;
    forum.access = f.access;
    forum.hidden = f.hidden == 1;
    forum.catId = f.cat;

    parse(posts).filter(p => p.forum === forum.id).forEach(p => {
        const post: PostData = new PostData(p.id);
        post.title = p.title;
        post.content = p.content;
        post.author = p.author;
        post.date = p.date;
        post.likes = p.likes;
        post.forumId = p.forum;

        forum.posts.push(post);
    });
    if (posts[0].id === -18348) return { status: 0, forum: forum };
    return { status: 1, forum: forum };
}

module.exports = router;