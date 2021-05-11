declare module 'express-session' {
    interface SessionData {
        uuid: string
        token: string
        lang: string
    }
}