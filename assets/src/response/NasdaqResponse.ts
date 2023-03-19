import {CompanySymbol} from "@/model";
import DefaultResponse from "./DefaultResponse";

export interface NasdaqResponse extends DefaultResponse {
    data: CompanySymbol[];
};
