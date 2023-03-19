import {Price} from "@/model";
import DefaultResponse from "./DefaultResponse";

export interface RapidResponse extends DefaultResponse {
    data: {
        eventsData: []
        firstTradeDate: number
        id: string
        isPending: boolean
        prices: Price[]
        timeZone: {
            gmtOffset: number
        }
    }
}
