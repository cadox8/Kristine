/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {Config} from "./Config";
import {Database} from "../database/Database";
import {Category} from "./data/Category";
import {Rank} from "./Rank";
import {ForumData} from "./data/ForumData";
import {PostData} from "./data/PostData";
import {Author} from "./data/Author";

export class Forum {

    public readonly config: Config;
    public readonly database: Database;

    public readonly categories: Category[];
    public readonly ranks: Rank[];

    constructor() {
        this.config = new Config();
        this.database = new Database(this.config);

        this.categories = [];
        this.ranks = [];

        this.loadForum();
    }

    public loadForum(): void {
        Database.query("SELECT * FROM `cat`", (error, categories) => {
            Database.query("SELECT * FROM `forum`", (error, forums) => {
                Database.query("SELECT * FROM `posts`", (error, posts) => {
                    Database.query("SELECT `id`, `name`, `icon` FROM `users`", (error, users) => {
                        const cats: { status: number, cats: Category[] } = this.loadData(categories, forums, posts, users);
                        this.categories.length = 0
                        cats.cats.forEach(c => this.categories.push(c));
                    });
                });
            })
        });
    }

    private loadData = (categories, forums, posts, users): { status: number, cats: Category[] } => {
        let cat: Category[] = [];

        this.parse(categories).forEach(r => {
            const category: Category = new Category(r.id);
            category.title = r.title;
            category.description = r.desc;
            category.hidden = r.hidden == 1;

            this.parse(forums).filter(f => f.cat === category.id).forEach(f => {
                const forum: ForumData = new ForumData(f.id);
                forum.title = f.title;
                forum.description = f.desc;
                forum.hidden = f.hidden == 1;
                forum.catId = f.cat;

                this.parse(posts).filter(p => p.forum === forum.id).forEach(p => {
                    const post: PostData = new PostData(p.id);
                    post.title = p.title;
                    post.content = p.content;
                    post.date = p.date;
                    post.likes = p.likes;
                    post.forumId = p.forum;

                    const authorData = this.parse(users).find(u => u.id === p.author);
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

    private parse = (data: string): any => {
        if (data === null || data === undefined) return [ { id: -18348 } ];
        return JSON.parse(JSON.stringify(data));
    }
}