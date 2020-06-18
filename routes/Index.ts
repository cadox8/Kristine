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
import {Category} from "../forum/data/Category";
import {Website} from "../Website";
import {Lang} from "../lang/Lang";
import {ForumData} from "../forum/data/ForumData";
import {PostData} from "../forum/data/PostData";
import {Author} from "../forum/data/Author";
import {Utils} from "../utils/Utils";

const router = Router();

router.get('/', (req, res, next) => {
    Database.hasConnection(connection => {
        if (connection) {
            res.render('errors/503');
            return;
        }
    });

    Database.query("SELECT * FROM `cat`", (error, categories) => {
        Database.query("SELECT * FROM `forum`", (error, forums) => {
            Database.query("SELECT * FROM `posts`", (error, posts) => {
                Database.query("SELECT `id`, `name`, `icon` FROM `users`", (error, users) => {
                    const lang = req.session.name == null ? Website.config.lang : req.session.lang;
                    const data = {
                        siteName: Website.config.siteName,
                        lang: new Lang(lang),
                        utils: new Utils()
                    }
                    const cats: { status: number, cats: Category[] } = loadData(categories, forums, posts, users);
                    if (cats.status === 0) return;
                    res.render('index', { title: 'Index', content: cats.cats, data: data });
                });
            });
        })
    });
});

const parse = (data: string): any => {
    if (data === null || data === undefined) return [ { id: -18348 } ];
    return JSON.parse(JSON.stringify(data));
}

const loadData = (categories, forums, posts, users): { status: number, cats: Category[] } => {
    let cat: Category[] = [];

    parse(categories).forEach(r => {
        const category: Category = new Category(r.id);
        category.title = r.title;
        category.description = r.desc;
        category.access = r.access;
        category.hidden = r.hidden == 1;

        parse(forums).filter(f => f.cat === category.id).forEach(f => {
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
                post.date = p.date;
                post.likes = p.likes;
                post.forumId = p.forum;

                const authorData = parse(users).find(u => u.id === p.author);
                if (authorData === null) {
                    post.author = new Author(-1, '', 'null', 'user.png')
                } else {
                    post.author = new Author(authorData.id, '', authorData.name, authorData.icon);
                }

                forum.posts.push(post);
            })
            category.forums.push(forum)
        })
        cat.push(category);
    });
    if (cat[0].id === -18348) return { status: 0, cats: cat };
    return { status: 1, cats: cat };
}

module.exports = router;