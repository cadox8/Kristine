/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Config} from "./Config";
import {defaultRanks, Rank} from "./ranks/Rank";
import {Category} from "./data/Category";
import {Database} from "../db/Database";
import {ForumData} from "./data/ForumData";
import {PostData} from "./data/PostData";
import {Author} from "./data/Author";
import {Achievement} from "./achievements/Achievement";

export class Forum {

    public static instance: Forum;

    private readonly _config: Config;

    private readonly _ranks: Rank[];
    private readonly _categories: Category[];

    private readonly _achievements: Achievement[];

    constructor() {
        Forum.instance = this;

        this._config = new Config();

        this._ranks = [];
        this._categories = [];
        this._achievements = [];
    }

    get config(): Config {
        return this._config;
    }

    get ranks(): Rank[] {
        return this._ranks;
    }

    get categories(): Category[] {
        return this._categories;
    }

    public addRank(rank: Rank): void {
        this._ranks.push(rank);
    }

    public removeRank(rank: Rank): void {
        this._ranks.splice(this._ranks.indexOf(this.getRank(rank.id)), 1);
    }

    public getRank(id: number): Rank {
        return this._ranks.find(r => r.id == id);
    }

    public hasRank(rank: Rank): boolean {
        return this._ranks.includes(rank);
    }

    public getForums(category: number): ForumData[] {
        return this.categories.find(c => c.id === category).forums;
    }

    public getForum(forum: number): ForumData {
        return this.categories.find(c => c.forums.find(f => f.id === forum).catId).forums.find(f => f.id === forum);
    }

    public getPost(forum: number, post: number): PostData {
        return this.getForum(forum).posts.find(p => p.id === post);
    }


    // Loaders
    public loader(): void {
        this.loadRanks();
        this.loadForum();
    }

    private loadForum(): void {
        Database.query("SELECT * FROM `cat`", (error, categories) => {
            Database.query("SELECT * FROM `forum`", (error, forums) => {
                Database.query("SELECT * FROM `posts`", (error, posts) => {
                    Database.query("SELECT `id`, `name`, `icon` FROM `users`", (error, users) => {
                        const cats: { status: number, cats: Category[] } = this.loadData(categories, forums, posts, users);
                        cats.cats.forEach(c => this._categories.push(c));
                    });
                });
            })
        });
    }

    private loadRanks(): void {
        Database.query("SELECT * FROM `ranks`", (err, result) => {
            if (err) { // Load default ranks
                defaultRanks().forEach(r => this.addRank(r));
                return;
            }
            const ranks = JSON.parse(JSON.stringify(result));
            ranks.forEach(r => {
                const rank: Rank = new Rank(r.id);
                rank.name = r.name;
                rank.permissions = r.permissions;
                rank.rank = r.rank;
                this.addRank(rank);
            })
        })
    }

    private loadData = (categories, forums, posts, users): { status: number, cats: Category[] } => {
        let cat: Category[] = [];

        this.parse(categories).forEach(r => {
            const category: Category = new Category(r.id);
            category.title = r.title;
            category.description = r.desc;
            category.access = r.access;
            category.hidden = r.hidden == 1;

            this.parse(forums).filter(f => f.cat === category.id).forEach(f => {
                const forum: ForumData = new ForumData(f.id);
                forum.title = f.title;
                forum.description = f.desc;
                forum.access = f.access;
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